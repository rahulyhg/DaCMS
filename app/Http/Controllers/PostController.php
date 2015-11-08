<?php namespace App\Http\Controllers;

use App;
use App\Post;
use App\Category;
use App\User;
use Auth;
use Asset;
use Redirect;
use Validator;
use Input;

class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getIndex', 'getView']]);
        $this->middleware('admin', ['except' => ['getIndex','getView']]);
    }


    public function getIndex()
    {

        // get current language
        $lang = $this->getLang();

        // meta
        $meta['title'] = 'Blog';
        $meta['canonical'] = env('APP_URL').'blog/';
        $meta['robots'] = 'index,follow,noodp,noydir';
        $meta['description'] = 'Blog page';
        $meta['keywords'] = 'blog';

        // page assets
        Asset::add(secure_url('js/blog.js'));

        // get data from models
        $posts = Post::where('isVisible', '=', '1')->where('lang', '=', $lang)->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::get();
        $authors = User::take(10)->get();

        // check for problems
        $posts->setPath(secure_url('blog')); // fix pagintor

        // get the view
        return view('post.index')->with('posts', $posts)->with('categories', $categories)->with('authors', $authors);
    }



    public function getView($slug)
    {
        // get current language
        $lang = $this->getLang();

        // get needed data from models
        $post = Post::where('slug', '=', $slug)->where('lang', '=', $lang)->first();
        $categories = Category::get();
        $authors = User::take(10)->get();

        // check for problems
        if (empty($post)) $post = Post::where('slug','=',$slug)->first(); // wrong language
        if (empty($post)) return view('errors.404'); // not found
        if ( ($post->isVisible != 1) && ( (!Auth::user()) || (Auth::user()->id != $post->user_id) ) ) return view('errors.403'); // draft

        // meta
        $meta['title'] = $post->title;
        $meta['canonical'] = env('APP_URL').'blog/'.$post->slug;
        $meta['robots'] = $post->robots;
        $meta['description'] = $post->description;
        $meta['keywords'] = $post->keywords;

        // page assets
        Asset::add(secure_url('js/blog.js'));
        Asset::add(secure_url('js/disqus.js'));

        // get the view
        return view('post.view')->with('meta', $meta)->with('post', $post)->with('categories', $categories)->with('authors', $authors);
    }


}