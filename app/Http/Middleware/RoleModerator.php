<?php namespace App\Http\Middleware;

use Closure;

class RoleModerator
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

		if (!in_array(\Auth::user()->role(\Auth::user()->id), ['owner', 'admin', 'moderator']) )
		{
			return view('errors.403');
		}

		return $next($request);
	}

}
