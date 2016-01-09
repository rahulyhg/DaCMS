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


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getIndex','getView']]);
        $this->middleware('editor', ['except' => ['getIndex','getView','getDelete','postDelete']]);
        $this->middleware('moderator', ['only' => ['getDelete','postDelete']]);
    }



    public function getView($slug)
    {

        // get needed data from models
        $category = Category::where('slug', '=', $slug)->first();
        $categories = Category::get();
        $authors = User::take(10)->get();

        // check for problems
        if (empty($category)) return abort('404'); // not found

        // meta
        $meta['title'] = "Category: " . $category->name;
        $meta['canonical'] = secure_url('category/'.$category->slug);
        $meta['description'] = 'Posts from category ' . $category->name;;
        $meta['keywords'] = 'posts, category, ' . $category->name;

        // page assets
        Asset::add(secure_url('js/blog.js'));

        // get the view
        return view('category.view')->with('meta', $meta)->with('category', $category)->with('categories', $categories)->with('authors', $authors);
    }



    public function getEdit($id)
    {
        $category = Category::where('id','=',$id)->first();

        $meta['title'] = 'Edit category';

        $s1 = "$('#deleteBtn').click(function(){window.location = '".secure_url('/category/del/'.$id)."';});";

        Asset::addScript($s1, 'ready');

        return view('category.edit')->with('meta', $meta)->with('category', $category);
    }



    public function postEdit($id)
    {
        $rules = array(
                'name'  => 'required|min:2|max:80',
                'slug' => 'required|min:2'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
                $data = array(
                   'name' => Input::get('name'),
                   'slug' => Input::get('slug')
                );

         Category::where('id','=',$id)->update($data);

        }

        return Redirect::secure('category/edit/'.$id)->withErrors($validation);
    }



    public function getCreate()
    {
        $meta['title'] = "Create category";

        return view('category.create')->with('meta', $meta);
        }



    public function postCreate()
    {
        $rules = array(
                'name'  => 'required|min:2|max:80',
                'slug' => 'required|min:2'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
                $data = array(
                   'name' => Input::get('name'),
                   'slug' => Input::get('slug')
                );

            Category::insert($data);

            return Redirect::secure('/category/'.Input::get('slug'));

        }

        return Redirect::secure('category/add')->withErrors($validation);
    }



    public function getDelete($id)
    {
        $category = Category::where('id','=',$id)->first();

        $meta['title'] = 'DELETE: ' . $category->name;

        return view('category.delete')->with('meta', $meta)->with('category', $category);
    }



    public function postDelete($id)
    {
        if (Input::get('confirm')==true)
        {
          Category::where('id','=',$id)->delete();

          return Redirect::secure('/');
        }

        return Redirect::secure('category/del/'.$id);
    }


}