<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Validator;
use Redirect;
use Auth;
use DB;
use Markdown;
use Log;

use App\Http\Requests;

use App\Article;
use App\Tag;
use App\User;

class ArticleController extends Controller
{
    /*
     * Add middleware
     */
    public function __construct()
    {
        $this->middleware('auth', array('only' => array('create', 'store', 'edit', 'update', 'destroy')));
        $this->middleware('canOperation',array('only' => array('edit', 'update', 'destroy')));
    }

    /*
     * Show article creating page
     */
    public function create()
    {
        return view('articles.create');
    }

    /*
     * Create Article
     */
    public function store()
    {
        $rules = [
            'title'     => 'required|max:100',
            'content'   => 'required',
            'tags'      => array('required', 'regex:/^w+$|^(\w+,)+\w+$/'),
        ];
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->passes()) {
            //$article = Article::create(Request::only('title', 'content'));
            DB::beginTransaction();
            try {
                $article = new Article;
                $article->title = Request::input('title');
                $article->content = Request::input('content');
                $article->user_id = Auth::id();
                $resolved_content = Markdown::parse(Request::input('content'));
                $article->resolved_content = $resolved_content;
                $tags = explode(',', Request::input('tags'));
                if (str_contains($resolved_content, '<p>')) {
                    $start = strpos($resolved_content, '<p>');
                    $length = strpos($resolved_content, '</p>') - $start - 3;
                    if ($length < 255)
                        $article->summary = substr($resolved_content, $start+3, $length);
                    else
                        $article->summary = substr($resolved_content, $start+3, 254);
                } else if (str_contains($resolved_content, '</h>')) {
                    $start = strpos($resolved_content, '<h');
                    $length = strpos($resolved_content, '</h') - $start - 4;
                    if ($length < 255)
                        $article->summary = substr($resolved_content, $start + 4, $length);
                    else
                        $article->summary = substr($resolved_content, $start + 4, 254);
                }
                $article->save();
                foreach ($tags as $tagName) {
                    $tag = Tag::whereName($tagName)->first();
                    if (!$tag) {
                        $tag = New Tag;
                        $tag->name = $tagName;
                    }
                    $tag->count++;
                    $tag->save();
                   $article->tags()->save($tag);
                }
                DB::commit();
                return Redirect::route('article.show', $article->id);
            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
        } else {
            return Redirect::route('article.create')->withInput()->withErrors($validator);
        }
    }


    /*
     * Show article list
     */
    public function show($id)
    {
        return view('articles.show')->with('article', Article::find($id));
    }

    /*
     * Show article edit page
     */
    public function edit($id)
    {
        $article = Article::with('tags')->find($id);
        $tags = '';
        for ($i = 0, $len = count($article->tags); $i < $len; $i++) {
            $tags .= $article->tags[$i]->name . ($i == $len - 1 ? '':','    );
        }
        $article->tags = $tags;
        return view('articles.edit')->with('article', $article);
    }

    /*
     *  Preview Article Content
     */
    public function preview()
    {
        //Log::info('Preview Controller received : ');
        return Markdown::parse(Request::input('content'));
    }

    /*
     * update Article
     */
    public function update($id)
    {
        $rules = [
            'title' => 'required|max:100',
            'content' => 'required',
            'tags' => array('required', 'regex:/^\w+$|^(\w+,)+\w+$/'),
        ];
        $validator = Validator::make(Request::all(), $rules);
    //clock()->startEvent('article.update',"james.yang");
    //clock(Request::input('tags'));
    //clock()->endEvent('article.update');
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $article = Article::with('tags')->find($id);
                $article->update(Request::only('title', 'content'));
                $resolved_content = Markdown::parse(Request::input('content'));
                $article->resolved_content = $resolved_content;
                $tags = array_unique(explode(',', Request::input('tags')));
                // set summary
                if (str_contains($resolved_content, '<p>')) {
                    $start = strpos($resolved_content, '<p>');
                    $length = strpos($resolved_content, '</p>') - $start - 3;
                    if ($length < 255) {
                        $article->summary = substr($resolved_content, $start + 3, $length);
                    } else {
                        $article->summary = substr($resolved_content, $start + 3, 254);
                    }

                } elseif (str_contains($resolved_content, '</h')) {
                    $start = strpos($resolved_content, '<h');
                    $length = strpos($resolved_content,'</h') - $start - 4;
                    if ($length < 255) {
                        $article->summary = substr($resolved_content, $start + 4, $length);
                    } else {
                        $article->summary = substr($resolved_content, $start + 4, 254);
                    }
                } else {
                    $article->summary = $article->title;
                }
                $article->save();
                foreach ($article->tags as $tag) {
                    if (($index = array_search($tag->name, $tags)) !== false) {
                        unset($tags[$index]); // unmodified tags, remove from $tags
                    } else {    // Deleted tags, reduce tag count and delete from article_tag table
                        $tag->count--;
                        $tag->save();
                        $article->tags()->detach($tag->id);
                    }
                }
                foreach ($tags as $tagName) { // Added Tags,increase count and insert into article_tag table
                    /*
                    $tag = Tag::whereName($tagName)->first();
                    if (!$tag) {
                        $tag = Tag::create(array('name' => $tagName));
                    }
                    */
                    $tag = Tag::firstOrNew(array('name' => $tagName));

                    $tag->count++;
                    $article->tags()->save($tag);
                }
                DB::commit();
                return Redirect::route('article.show', $article->id);
            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
        } else {
            return Redirect::route('article.edit', $id)->withInput()->withErrors($validator);
        }
    }

    /*
     * Destroy article, soft delete
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        foreach($article->tags as $tag) {
            $tag->count--;
            $tag->save();
            $article->tags()->detach($tag->id);
        }
        $article->delete();
        return Redirect::to('home');
    }
}
