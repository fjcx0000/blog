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
use App\Article,App\Tag;
//use TestService;

Route::get('/', function () {
    clock()->startEvent('debugEvent', 'LavavelAcademy.org');
    clock('Message text.');
    Logger('Message text.');
    clock(array('hello' => 'world', 'goodby' => 'yesterday'));
    $articles = Article::with('user', 'tags')->orderBy('created_at', 'desc')->paginate(env('PAGINATION_NUMBER', 2));
    $tags = Tag::where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->take(10)->get();
    clock($tags);
    clock()->endEvent('debugEvent');
    return view('index')->with('articles', $articles)->with('tags', $tags);
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
    return view('home')->with('user', Auth::user())->with('articles', Article::with('tags')->where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get());
}));

Route::get('logout', array('before' => 'auth', function() {
    Auth::logout();
    return Redirect::to('/');
}));

Route::get('register', function() {
    return view('users.create');
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

Route::get('user/{id}/edit', array('before' => 'auth', 'as' => 'user.edit', function($id)
{
    if (Auth::user()->is_admin or Auth::id() == $id) {
        return view('users.edit')->with('user', User::find($id));
    } else {
        return Redirect::to('/');
    }
}));

Route::put('user/{id}', array('before' => 'auth|csrf', function($id)
{
    if (Auth::user()->is_admin or (Auth::id() == $id)) {
        $user = User::find($id);
        $rules = array(
            'password' => 'required_with:old_password|min:6|confirmed',
            'old_password' => 'min:6',
        );
        if (!(Request::get('nickname') == $user->nickname))
        {
            $rules['nickname'] = 'required|min:4|unique:users,nickname';
        }
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->passes()) {
            if (!(Request::get('old_password') == '')) {
                if (!Hash::check(Request::get('old_password'), $user->password)) {
                    return Redirect::route('user.edit', $id)->with('user', $user)->with('message', array('type' => 'danger', 'content' => 'old password error'));
                } else {
                    $user->password = Hash::make(Request::get('password'));
                }
            } 
            $user->nickname = Request::get('nickname');
            $user->save();
            return Redirect::route('user.edit', $id)->with('user', $user)->with('message', array('type' => 'success', 'content' => 'Modify Successfully'));
        } else {
            return Redirect::route('user.edit', $id)->withInput()->with('user', $user)->withErrors($validator);
        }
    } else {
        return Redirect::to('/');
    }
}));

Route::group(array('prefix' => 'admin', 'middleware' => array('auth','isAdmin')), function() {
    Route::get('users', function() {
        return view('admin.users.list')->with('users', User::all())->with('page', 'users');
    });
    Route::get('articles', 'AdminController@articles');
    Route::get('tags', 'AdminController@tags');
});

//Route::model('user', 'User');

Route::group(array('before' => 'auth|csrf|isAdmin'), function() {
    Route::put('user/{user}/reset', function(User $user) {
        $user->password = Hash::make('123456');
        $user->save();
        return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => 'Reset password successfully'));
    });

    Route::delete('user/{user}', function(User $user) {
        $user->block = 1;
        $user->save();
        return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => 'Lock user successfully'));
    });

    Route::put('user/{user}/unblock', function(User $user) {
        $user->block = 0;
        $user->save();
        return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => 'Unlock user successfully'));
    });
});
                        
Route::post('article/preview', 'ArticleController@preview',['middleware' => 'auth']);
Route::post('article/{id}/preview', 'ArticleController@preview',['middleware' => 'auth']);

/*
 * route for articles
 */
Route::resource('article', 'ArticleController');
Route::get('user/{user}/articles', 'UserController@articles');

/*
 * route for tags
 */
Route::resource('tag', 'TagController');
Route::get('tag/{id}/articles', 'TagController@articles');