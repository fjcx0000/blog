<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User, App\Article;

class UserController extends Controller
{
    public function articles(User $user)
    {
        return view('home')->with('user', $user)->with('articles', Article::with('tags')->where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->get());
    }

}
