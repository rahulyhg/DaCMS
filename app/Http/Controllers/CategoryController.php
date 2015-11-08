<?php namespace App\Http\Controllers;

use App;
use App\Category;
use App\User;
use Auth;
use Asset;
use Redirect;
use Validator;
use Input;

class CategoryController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getIndex', 'getView']]);
        $this->middleware('admin', ['except' => ['getIndex','getView']]);
    }



    public function getView($slug)
    {

        // get needed data from models
        $category = Category::where('slug', '=', $slug)->first();
        $categories = Category::get();
        $authors = User::take(10)->get();

        // check for problems
        if (empty($category)) return view('errors.404'); // not found

        // meta
        $meta['title'] = "Category: " . $category->name;
        $meta['canonical'] = env('APP_URL').'category/'.$category->slug;
        $meta['description'] = 'Posts from category ' . $category->name;;
        $meta['keywords'] = 'posts, category, ' . $category->name;

        // page assets
        Asset::add(secure_url('js/blog.js'));

        // get the view
        return view('category.view')->with('meta', $meta)->with('category', $category)->with('categories', $categories)->with('authors', $authors);
    }


}