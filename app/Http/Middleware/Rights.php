<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Rights
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
		preg_match("/(?<=\/)[0-9]+$/", $request->path(), $matches);
		if ($matches) {
			$pathId = (int) $matches[0];
		}
		if (Auth::check()) {

			if (Auth::user()->admin || ($pathId && Auth::user()->id == $pathId)) {
				return $next($request);
			}
		}

		return response($pathId, 403);
	}
}
