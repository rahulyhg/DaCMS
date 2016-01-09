<?php namespace App\Http\Middleware;

use Closure;

class RoleAdmin
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

		if (!in_array(\Auth::user()->role(\Auth::user()->id), ['owner', 'admin']) )
		{
			return abort('403');
		}

		return $next($request);
	}

}
