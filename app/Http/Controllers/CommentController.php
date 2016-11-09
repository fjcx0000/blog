<?php

namespace App\Http\Controllers;

use App\Comment;
use Request,Response,Validator,Auth,Redirect;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store  new comment
     * @return mixed
     */
    public function store()
    {
        $rules = [
            'content' => 'required|max:256',
        ];

     clock("comment is ".Request::input('content'));
        $validator = Validator::make(Request::all(),$rules);
        if ($validator->passes()) {
            $comment = new Comment;
            $comment->content = Request::input('content');
            $comment->user_id = Auth::id();
            $comment->article_id = Request::input('article_id');
            $comment->save();
            return Redirect::back();
        } else {
            return Redirect::route('article.show')->withInput()->withErrors($validator);
        }
    }
    public function destroy()
    {

    }
}
