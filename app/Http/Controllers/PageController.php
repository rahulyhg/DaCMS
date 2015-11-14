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
        //$this->middleware('auth', ['except' => ['getAbout','getPrivacy']]);
        //$this->middleware('admin', ['except' => ['getAbout','getPrivacy']]);
    }



    public function getIndex()
    {
        //
    }



    public function getView($slug='home')
    {
        $page = Page::where('slug','=',$slug)->first();

        if (empty($page)) return view('errors.404'); // not found

        return view('page.view')->with('page',$page);
    }



    public function getEdit($id)
    {
        $page = Page::where('id','=',$id)->first();

        $meta['title'] = 'Редактирай: '.$page->title.' | Roumen.IT';

        Asset::add('https://cdn.roumen.it/repo/ckeditor/ckeditor.js');
        Asset::add(secure_url('/js/page_edit.js'));

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
                   'lang' => Input::get('lang'),
                   'modified' => date('Y-m-d H:i:s')
                );

         Page::where('id','=',$id)->update($data);

        }

        return Redirect::secure('page/edit/'.$id)->withErrors($validation);
    }


    public function getCreate()
    {
        $meta['title'] = "Create page";

        Asset::add('https://cdn.roumen.it/repo/ckeditor/ckeditor.js');
        Asset::add(secure_url('/js/page_edit.js'));

        return view('page.create')->with('meta', $meta);
    }


    public function postCreate()
    {
        // todo
    }


    public function getDelete($id)
    {
        $page = Page::where_id($id)->first();

        $meta['title'] = 'DELETE: ' . $page->title .' | Roumen.IT';
        $meta['canonical'] = 'http://roumen.it/page/'.$page->slug;

        return view('page.delete')->with('meta', $meta)->with('page', $page->to_array());
    }


    public function postDelete($id)
    {
          if (Input::get('confirm')==true)
          {
              Page::where_id($id)->delete();

              return Redirect::secure('/');
          }

          return Redirect::secure('page/del/'.$id);
    }


}