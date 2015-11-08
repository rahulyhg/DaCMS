<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Config;

abstract class Controller extends BaseController
{
	use DispatchesCommands, ValidatesRequests;

	// get app's current language
	protected function getLang()
	{
		return Config::get('app.locale');
	}

}
