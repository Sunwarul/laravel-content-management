<?php

namespace App\Http\Middleware;

use App\Categories;
use Closure;

class VerifyCategoryCount
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
        if(Categories::all()->count() === 0) {
            return redirect()->back()->with('error', 'Create a category first!');
        }
        return $next($request);
    }
}
