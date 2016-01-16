<?php namespace App\Http\Middleware;

use Closure;

class RoleEditor
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

		if ( \Auth::check() && \Auth::user()->role > 5  )
		{
			return abort('403');
		}

		return $next($request);
	}

}
