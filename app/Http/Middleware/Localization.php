<?php namespace App\Http\Middleware;

use Closure;
use App;

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
		// detect bots
		/*if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|google|yahoo|bing|yandex|facebook|slurp|spider/i', $_SERVER['HTTP_USER_AGENT']))
		{
				setcookie("lang", 'bg', time()+3600*24*365);
		    	$lang = 'bg';
		} else
			{
				// set languages
				if(isset($_COOKIE["lang"]))
				{
				    $lang = $_COOKIE["lang"];
				}
				else
				{	// if not BG
					if (isset($_SERVER["HTTP_CF_IPCOUNTRY"]) && $_SERVER["HTTP_CF_IPCOUNTRY"] != 'BG')
					{
						setcookie("lang", 'en', time()+3600*24*365, '/');
				    	$lang = 'en';
					} else
						{
							setcookie("lang", 'bg', time()+3600*24*365, '/');
				    		$lang = 'bg';
						}
				}
			}
			*/

		// if cloudflare geolocation header exists
		if (isset($_SERVER["HTTP_CF_IPCOUNTRY"]))
		{
			$lang = strtolower($_SERVER["HTTP_CF_IPCOUNTRY"]);
			setcookie("lang", $lang, time()+3600*24*365, '/');
		}
		else
		{
    		$lang = env('APP_LOCALE');
		}

		// cookie
		setcookie("lang", $lang, time()+3600*24*365, '/');

		// set locale
		App::setLocale($lang);

		// next ?
		return $next($request);
	}

}
