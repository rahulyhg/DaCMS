<?php namespace App\Http\Middleware;

use Closure;
use Debugbar;
use Auth;
use Config;

class DebugbarAdmin
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
		// if user is not logged and is not moderator+
		// disable debug and don't show debugbar
		if ( Config::get('app.env') != 'local' && ( !Auth::user() || Auth::user()->role < 6 ) )
		{
			Debugbar::disable();
			Config::set('debugbar.enabled', false);
			Config::set('app.debug', false);
		}

		return $next($request);
	}

}
