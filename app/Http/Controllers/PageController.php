<?php namespace App\Http\Controllers;

use App;
use App\Page;
use Auth;
use Asset;
use Redirect;
use Validator;
use Input;
use Config;

class PageController extends Controller
{

	public function getIndex()
	{
		// TODO
	}

	public function getView($slug='home')
	{
		// get page by slug
		$page = Page::where('slug','=',$slug)->first();

		// if page is empty
		if (empty($page)) return abort('404'); // not found

		// get the view
		return view('page.view', ['page' => $page]);
	}

	public function getUpdate($id)
	{
		// get page to edit
		$page = Page::where('id','=',$id)->first();

		// if page is missing redirect to blog
		if (empty($page)) return Redirect::secure('blog');

		// get the view
		return view('page.update', ['page' => $page]);
	}

	public function postUpdate($id)
	{
		// update page
		return Page::updatePage($id, Input::all());
	}

	public function getCreate()
	{
		// get the view
		return view('page.create');
	}

	public function postCreate()
	{
		// create new page
		return Page::createPage(Input::all());
	}

	public function getDelete($id)
	{
		// get the page
		$page = Page::where('id','=',$id)->first();

		// get the view
		return view('page.delete', ['page' => $page]);
	}

	public function postDelete($id)
	{
		// delete page
		return Page::deletePage($id, Input::all());
	}


}