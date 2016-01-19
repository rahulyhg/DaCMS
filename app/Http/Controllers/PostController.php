<?php namespace App\Http\Controllers;

use App;
use App\Post;
use Asset;
use Redirect;
use Input;
use Config;

class PostController extends Controller
{

	public function getIndex()
	{
		// get latest posts
		$posts = Post::where('isVisible', '=', '1')->orderBy('created_at', 'desc')->with('tags','categories','author')->paginate(5);

		// fix pagination
		$posts->setPath(secure_url('blog'));

		// get the view
		return view('post.index', ['posts' => $posts]);
	}

	public function getView($slug)
	{
		// get needed data from models
		$post = Post::where('slug', '=', $slug)->with('author','tags','categories')->first();

		// if post not found
		if (empty($post)) return abort('404');

		// if post is a draft and user is not logged, is not the author of the post or is not admin
		if ( ($post->isVisible != 1) && ( (!$this->authUser) || ($this->authUser->id != $post->user_id) ) ) return abort('403');

		// get the view
		return view('post.view', ['post' => $post]);
	}

	public function Search()
	{
		// get data from models
		$s = Input::get('s', 'post');

		// get results
		$posts = Post::where('isVisible', '=', '1')->where('title', 'LIKE', "%$s%")
												   ->orWhere('content', 'LIKE', "%$s%")
												   ->orWhere('resume', 'LIKE', "%$s%")
												   ->orderBy('created_at', 'desc')
												   ->with('tags','categories','author')
												   ->paginate(5);

		// fix pagination
		$posts->setPath(secure_url('search'));

		// get the view
		return view('post.search', ['posts' => $posts, 's' => $s]);
	}

	public function getUpdate($id)
	{
		// get post to edit
		$post = Post::where('id','=',$id)->first();

		// get the view
		return view('post.update', ['post' => $post]);
	}

	public function postUpdate($id)
	{
		// update post
		return Post::updatePost($id, Input::all());
	}

	public function getCreate()
	{
		// get the view
		return view('post.create');
	}

	public function postCreate()
	{
		// create new post
		return Post::createPost(Input::all());
	}

	public function getDelete($id)
	{
		// get the post to delete
		$post = Post::where('id','=',$id)->first();

		// if post is missing redirect to blog
		if (empty($post)) Redirect::secure('blog');

		// get the view
		return view('post.delete', ['post' => $post]);
	}

	public function postDelete($id)
	{
	  	// delete post
	  	return Post::deletePost($id, Input::all());
	}

}