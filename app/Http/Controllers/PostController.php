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
       /*
        $lang = $this->getLang(false);

        if ($lang == 'en')
        {
            $meta['title'] = '';
            $meta['canonical'] = '';
            $meta['robots'] = 'index,follow,noodp,noydir';
            $meta['description'] = '';
            $meta['keywords'] = '';
        }

        */

        Asset::add(secure_url('js/blog.js'));

        $posts = Post::where('isVisible', '=', '1')->where('lang', '=', 'en')->orderBy('created_at', 'desc')->paginate(5);
        $posts->setPath(secure_url('blog'));

        $categories = Category::get();
        $authors = User::take(10)->get();

        return view('post.index')->with('posts', $posts)->with('categories', $categories)->with('authors', $authors);
    }


}