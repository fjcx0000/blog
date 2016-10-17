<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Article;

class CanOperation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!(Auth::user()->is_admin or Auth::id() == Article::find($request->article)->user_id))
        {
            //return Redirect::to('/');
            return redirect()->to('/');
        }
        return $next($request);
    }
}
