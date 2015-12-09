<?php namespace App\Http\Middleware;

use Closure;
use App;
use Config;

class Localization {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		// check if lang cookie exists and use it
		if(isset($_COOKIE["lang"]))
		{
			// use cookie lang
		    $lang = $_COOKIE["lang"];
		}
		else if (isset($_SERVER["HTTP_CF_IPCOUNTRY"]))
		{
			// if cloudflare geolocation header exists use it
			$lang = strtolower($_SERVER["HTTP_CF_IPCOUNTRY"]);
		}
		else
		{
			// no cookie, no cf header, use default lang
    		$lang = Config::get('app.locale');
		}

		// set cookie
		setcookie("lang", $lang, time()+3600*24*365, '/');

		// set locale
		App::setLocale($lang);

		// next ?
		return $next($request);
	}

}
