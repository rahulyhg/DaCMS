<?php namespace App\Http\Controllers;

use App;
use App\Tag;
use Asset;
use Auth;
use Redirect;
use Validator;
use Input;
use Config;

class TagController extends Controller
{

	public function getIndex()
	{
		// view
		return view('tag.index', ['tag'=>Tag::with('posts')->get()]);
	}

	public function getView($slug)
	{
		// get needed data from models
		$tag = Tag::where('slug', '=', $slug)->with('posts')->first();

		// not found
		if (empty($tag)) return abort('404');

		// get the view
		return view('tag.view', ['tag' => $tag]);
	}

	public function getUpdate($id)
	{
		// get tag to update
		$tag = Tag::where('id','=',$id)->first();

		// not found
		if (empty($tag)) return abort('404');

		// get the view
		return view('tag.update', ['tag' => $tag]);
	}

	public function postUpdate($id)
	{
		// update tag
		return Tag::updateTag($id, Input::all());
	}

	public function getCreate()
	{
		// get the view
		return view('tag.create');
	}

	public function postCreate()
	{
		// create tag
		return Tag::createTag(Input::all());
	}

	public function getDelete($id)
	{
		$tag = Tag::where('id','=',$id)->first();

		// not found
		if (empty($tag)) return abort('404');

		return view('tag.delete', ['tag' => $tag]);
	}

	public function postDelete($id)
	{
		// delete tag
		return Tag::deleteTag($id, Input::all());
	}


}