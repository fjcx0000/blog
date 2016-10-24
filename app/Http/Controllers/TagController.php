<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Tag;
use Validator,Redirect;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', array('only', array('create', 'store', 'edit', 'update', 'destroy')));
    }
    public function index()
    {
        return view('tags.list')->with('tags', Tag::all());
    }
    public function edit($id)
    {
        return view('tags.edit')->with('tag', Tag::find($id));
    }
    public function update($id)
    {
        $rules = array(
            'name' => array('required', 'regex:/^\w+$/'),
        );
        $validator = Validator::make(Request::only('name'), $rules);
        if ($validator->passes()) {
            Tag::find($id)->update(Request::only('name'));
            return Redirect::back()->with('message', array('type' => 'success', 'content' => 'Modify tag successfully'));
        } else {
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->count = 0;
        $tag->save();
        $arr_article_id = null;
        foreach($tag->articles as $article) {
            $arr_article_id[] = $article->id;
        }
        $tag->articles()->detach($arr_article_id);
        return Redirect::back();
    }
    public function articles($id)
    {
        $tag = Tag::find($id);
        $articles = $tag->articles()->orderBy('created_at', 'desc')->paginate(10);
        return view('articles.specificTag')->with('tag', $tag)->with('articles', $articles);
    }
}