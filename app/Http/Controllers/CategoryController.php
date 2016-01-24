<?php namespace App\Http\Controllers;

use App;
use App\Category;
use App\User;
use Auth;
use Asset;
use Redirect;
use Validator;
use Input;
use Config;

class CategoryController extends Controller
{

	public function getView($slug)
	{
		// get needed data from models
		$category = Category::where('slug', '=', $slug)->with('posts')->first();

		// not found
		if (empty($category)) return abort('404');

		// get the view
		return view('category.view', ['category' => $category]);
	}

	public function getUpdate($id)
	{
		// get category to update
		$category = Category::where('id','=',$id)->first();

		// not found
		if (empty($category)) return abort('404');

		// get the view
		return view('category.update', ['category' => $category]);
	}

	public function postUpdate($id)
	{
		// update categorory
		return Category::updateCategory($id, Input::all());
	}

	public function getCreate()
	{
		// get the view
		return view('category.create');
	}

	public function postCreate()
	{
		// create category
		return Category::createCategory(Input::all());
	}

	public function getDelete($id)
	{
		$category = Category::where('id','=',$id)->first();

		// not found
		if (empty($category)) return abort('404');

		return view('category.delete', ['category' => $category]);
	}

	public function postDelete($id)
	{
		// delete category
		return Category::deleteCategory($id, Input::all());
	}

}