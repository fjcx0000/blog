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
    public function __contruct()
    {
        $this->middleware('auth', array('only' => array('crate', 'store', 'edit', 'update', 'destroy')));
    }

    /*
     * Create Article
     */
    public function create()
    {
        return view('articles.create');
    }

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
                    $article->summary = substr($resolved_content, $start+3, $length);
                } else if (str_contains($resolved_content, '</h>')) {
                    $start = strpos($resolved_content, '<h');
                    $length = strpos($resolved_content, '</h') - $start - 4;
                    $article->summary = substr($resolved_content, $start + 4, $length);
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
     * Show article
     */
    public function show($id)
    {
        return view('articles.show')->with('article', Article::find($id));
    }

    /*
     *  Preview Article Content
     */
    public function preview()
    {
        //Log::info('Preview Controller received : ');
        return Markdown::parse(Request::input('content'));
    }
}
