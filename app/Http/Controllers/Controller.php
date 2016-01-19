<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Auth;
use Config;
use Cache;
use Asset;

abstract class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $authUser = null;
	public $lang = 'en';
	public $layout;
	public $sidebar;

    public function __construct()
	{
		// set authenticated user
		if (Auth::check()) $this->authUser = Auth::user();

		// set app language
		$this->lang = Config::get('app.locale');

		// set layout variables
		$this->layout = new \stdClass();
		$this->layout->title = Config::get('layout.title');
		$this->layout->description = Config::get('layout.description');
		$this->layout->keywords = Config::get('layout.keywords');
		$this->layout->robots = Config::get('layout.robots');
		$this->layout->canonical = Config::get('layout.canonical');
		$this->layout->sidebar = Config::get('layout.sidebar');

		// share $authUser, $lang and $layout with all views
		view()->composer('*', function ($view)
		{
		    $view->with('authUser', $this->authUser);
		    $view->with('lang', $this->lang);
		    $view->with('layout', $this->layout);
		});

		// if sidebar
		if ($this->layout->sidebar)
		{
			$this->sidebar = new \stdClass();

			// cache tags for sidebar
			if (Cache::has('sidebar-tags'))
			{
			    $this->sidebar->tags = Cache::get('sidebar-tags');
			}
			else
			{
			    $this->sidebar->tags  = \App\Tag::with('posts')->get();
			    Cache::put('sidebar-tags', $this->sidebar->tags, 30);
			}

			// cache categories for sidebar
			if (Cache::has('sidebar-categories'))
			{
			    $this->sidebar->categories = Cache::get('sidebar-categories');
			}
			else
			{
			    $this->sidebar->categories = \App\Category::with('posts')->get();
			    Cache::put('sidebar-categories', $this->sidebar->categories, 30);
			}

			// cache authors for sidebar
			if (Cache::has('sidebar-authors'))
			{
			    $this->sidebar->authors = Cache::get('sidebar-authors');
			}
			else
			{
			    $this->sidebar->authors = \App\User::with('posts')->get();
			    Cache::put('sidebar-authors', $this->sidebar->authors, 30);
			}

			// share tags, categories and authors with sidebar view
			view()->composer('layouts.inc.main.sidebar', function ($view)
			{
			    $view->with('tags', $this->sidebar->tags);
			    $view->with('categories', $this->sidebar->categories);
			    $view->with('authors', $this->sidebar->authors);
			});
		}
	}

}
