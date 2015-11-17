<?php namespace App\Http\Controllers;

use App;
use App\Tag;
use Asset;
use Auth;
use Redirect;
use Validator;
use Input;

class TagController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getIndex','getView']]);
        $this->middleware('editor', ['except' => ['getIndex','getView','getDelete','postDelete']]);
        $this->middleware('admin', ['only' => ['getDelete','postDelete']]);
    }



    public function getIndex()
    {
        $meta['title'] = 'Tag list | Roumen.IT';
        $meta['canonical'] = 'http://roumen.it/tag';
        $meta['keywords'] = 'tag list, tags';
        $meta['description'] = 'List of all popular tags that have been used in this website.';
        $meta['robots'] = 'noindex';

        return view('tag.index')->with('meta', $meta)->with('tags', Tag::get());
    }



    public function getView($slug=null)
    {

        $tag = Tag::where('slug','=',$slug)->first();
        if (empty($tag)) return view('errors.404');

        $meta['title'] = 'Tag: ' . $tag->name;
        $meta['description'] = 'List of posts and projects with tag: ' . $tag->name;
        $meta['canonical'] = env('APP_URL') . $tag->slug;
        $meta['keywords'] = 'tag, ' . $tag->slug;
        $meta['robots'] = 'index,follow';

        return view('tag.view')->with('meta', $meta)->with('tag', $tag);
    }



    public function getEdit($id)
    {
        $tag = Tag::where('id','=',$id)->first();

        $meta['title'] = 'Edit tag';

        $s1 = "$('#deleteBtn').click(function(){window.location = '".secure_url('/tag/del/'.$id)."';});";

        Asset::addScript($s1, 'ready');

        return view('tag.edit')->with('meta', $meta)->with('tag', $tag);
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

         Tag::where('id','=',$id)->update($data);

        }

        return Redirect::secure('tag/edit/'.$id)->withErrors($validation);
    }



    public function getCreate()
    {
        $meta['title'] = "Create tag";

        return view('tag.create')->with('meta', $meta);
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

            Tag::insert($data);

            return Redirect::secure('/tag/'.Input::get('slug'));

        }

        return Redirect::secure('tag/add')->withErrors($validation);
    }



    public function getDelete($id)
    {
        $tag = Tag::where('id','=',$id)->first();

        $meta['title'] = 'DELETE: ' . $tag->name;

        return view('tag.delete')->with('meta', $meta)->with('tag', $tag);
    }



    public function postDelete($id)
    {
        if (Input::get('confirm')==true)
        {
          Tag::where('id','=',$id)->delete();

          return Redirect::secure('/');
        }

        return Redirect::secure('tag/del/'.$id);
    }


}