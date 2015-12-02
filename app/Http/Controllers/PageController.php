<?php namespace App\Http\Controllers;

use App;
use App\Page;
use Auth;
use Asset;
use Redirect;
use Validator;
use Input;

class PageController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getIndex','getView']]);
        $this->middleware('editor', ['except' => ['getIndex','getView','getDelete','postDelete']]);
        $this->middleware('moderator', ['only' => ['getDelete','postDelete']]);
    }



    public function getIndex()
    {
        // TODO
    }



    public function getView($slug='home')
    {
        $page = Page::where('slug','=',$slug)->first();

        if (empty($page)) return view('errors.404'); // not found

        //meta
        $meta['title'] = $page->title;
        $meta['description'] = $page->description;
        $meta['keywords'] = $page->keywords;
        $meta['canonical'] = ($slug!='home') ? secure_url($page->slug) : secure_url('');
        $meta['robots'] = $page->robots;

        return view('page.view')->with('page', $page)->with('meta', $meta);
    }



    public function getEdit($id)
    {
        $page = Page::where('id','=',$id)->first();

        $meta['title'] = 'Edit page';

        $s1 = "$(function(){CKEDITOR.replace('page_content',{toolbar:'Standart',height:'300px',width:'760px',toolbarCanCollapse:true,toolbarStartupExpanded:true,startupShowBorders:true});});";
        $s2 = "$('#deleteBtn').click(function(){window.location = '".secure_url('/page/del/'.$id)."';});";

        Asset::add('https://cdn.roumen.it/repo/ckeditor/4.4.6/basic/ckeditor.js');
        Asset::addScript($s1, 'ready');
        Asset::addScript($s2, 'ready');

        return view('page.edit')->with('meta', $meta)->with('page', $page);
    }



    public function postEdit($id)
    {
        $rules = array(
                'title'  => 'required|min:3|max:80',
                'slug' => 'required|min:3',
                'page_content'  => 'required|min:15',
                'description'  => 'required|min:10|max:180',
                'keywords' => 'required|min:3|max:90'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
                $data = array(
                   'title' => Input::get('title'),
                   'slug' => Input::get('slug'),
                   'content' => Input::get('page_content'),
                   'description' => Input::get('description'),
                   'keywords' => Input::get('keywords'),
                   'robots' => Input::get('robots'),
                   'lang' => Input::get('lang')
                );

         Page::where('id','=',$id)->update($data);

        }

        return Redirect::secure('page/edit/'.$id)->withErrors($validation);
    }



    public function getCreate()
    {
        $meta['title'] = "Create page";

        Asset::add('https://cdn.roumen.it/repo/ckeditor/4.4.6/basic/ckeditor.js');
        $script = "$(function(){CKEDITOR.replace('page_content',{toolbar:'Standart',height:'300px',width:'760px',toolbarCanCollapse:true,toolbarStartupExpanded:true,startupShowBorders:true});});";
        Asset::addScript($script, 'ready');

        return view('page.create')->with('meta', $meta);
    }



    public function postCreate()
    {
        $rules = array(
                'title'  => 'required|min:3|max:80',
                'slug' => 'required|min:3',
                'page_content'  => 'required|min:15',
                'description'  => 'required|min:10|max:180',
                'keywords' => 'required|min:3|max:90'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
                $data = array(
                   'title' => Input::get('title'),
                   'slug' => Input::get('slug'),
                   'content' => Input::get('page_content'),
                   'description' => Input::get('description'),
                   'keywords' => Input::get('keywords'),
                   'robots' => Input::get('robots'),
                   'lang' => Input::get('lang'),
                   'user_id' => Auth::user()->id
                );

         Page::insert($data);

         return Redirect::secure('/'.Input::get('slug'));

        }

        return Redirect::secure('page/add')->withErrors($validation);
    }



    public function getDelete($id)
    {
        $page = Page::where('id','=',$id)->first();

        $meta['title'] = 'DELETE: ' . $page->title;

        return view('page.delete')->with('meta', $meta)->with('page', $page);
    }



    public function postDelete($id)
    {
          if (Input::get('confirm')==true)
          {
              Page::where('id','=',$id)->delete();

              return Redirect::secure('/');
          }

          return Redirect::secure('page/del/'.$id);
    }



}