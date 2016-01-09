<?php namespace App\Http\Middleware;

use Closure;

class RoleAuthor
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

		if ($request->input('id') != \Auth::user()->id)
		{
            return abort('403');
        }

		return $next($request);
	}

}
