<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\User;

Route::get('/', function () {
    return view('index');
});
Route::get('login', function() {
    return view('login');
});
Route::post('login', array('before' => 'csrf', function() {
    $rules = array(
        'email' => 'required|email',
        'password' => 'required|min:6',
        'remember_me' => 'boolean',
    );
    $validator = Validator::make(Request::all(), $rules);
    if ($validator->passes())
    {
        if (Auth::attempt(array(
            'email' => Request::get('email'),
            'password' => Request::get('password'),
            'block' => 0), (boolean) Request::get('remember_me')))
        {
            return Redirect::intended('home');
        } else {
            return Redirect::to('login')->withInput()->with('message', array('type' => 'danger', 'content' => 'E-mail or password error'));
        }
    } else {
        return Redirect::to('login')->withInput()->withErrors($validator);
    }
}));

Route::get('home', array('before' => 'auth', function() {
    //var_dump(Request::user());
    //$user = Request::user();
    //echo $user->nickname;
    return view('home')->with('user', Request::user());
}));

Route::get('logout', array('before' => 'auth', function() {
    Auth::logout();
    return Redirect::to('/');
}));

Route::get('register', function() {
    return view('create');
});

Route::post('register', array('before'=>'csrf', function() {
    $rules = array(
        'email' => 'required|email|unique:users,email',
        'name' => 'required|min:6',
        'nickname' => 'required|min:4|unique:users,nickname',
        'password' => 'required|min:6|confirmed',
    );
    $validator = Validator::make(Request::all(), $rules);
    if ($validator->passes()) {
        $user = User::create(Request::only('email','name', 'nickname', 'password' ));
        $user->password = Hash::make(Request::get('password'));
        if ($user->save())
        {
            return Redirect::to('login')->with('message', array('type'=>'success', 'content'=>'Register successfully, please login'));
        } else {
            return Redirect::to('register')->withInput()->with('message', array('type' => 'danger', 'content' => 'Register failed'));
        }
    } else {
        return Redirect::to('register')->withInput()->withErrors($validator);
    }
}));
