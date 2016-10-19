<?php
/**
 * Created by PhpStorm.
 * User: think
 * Date: 17/10/2016
 * Time: 11:06 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Article;
use App\Tag;
use App\User;

class AdminController extends Controller
{
    public function articles()
    {
        return view('admin.articles.list')->with('articles', Article::with('user', 'tags')->orderBy('created_at', 'desc')->get())->with('page', 'articles');
    }
    public function tags()
    {
        return view('admin.tags.list')->with('tags', Tag::orderBy('count', 'desc')->get())->with('page', 'tags');
    }
}