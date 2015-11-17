<?php namespace App\Http\Controllers;

use App;
use App\Post;
use App\Category;
use App\User;
use App\Tag;
use Auth;
use Asset;
use Redirect;
use Validator;
use Input;

class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getIndex','getView','Search']]);
        $this->middleware('editor', ['except' => ['getIndex','getView','Search','getDelete','postDelete']]);
        $this->middleware('moderator', ['only' => ['getDelete','postDelete']]);
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
        $posts = Post::where('isVisible', '=', '1')->orderBy('created_at', 'desc')->paginate(5);

        // check for problems
        $posts->setPath(secure_url('blog')); // fix pagintor

        // get the view
        return view('post.index')->with('posts', $posts)->with('meta', $meta);
    }



    public function getView($slug)
    {
        // get current language
        $lang = $this->getLang();

        // get needed data from models
        $post = Post::where('slug', '=', $slug)->where('lang', '=', $lang)->first();
        $categories = Category::get();
        $tags = Tag::get();
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
        Asset::add(secure_url('/js/blog.js'));

        if ($post->isDisqus == 1)
        {
            Asset::add('https://ws.sharethis.com/button/buttons.js');
            Asset::addScript('var disqus_config=function(){this.language="'.$lang.'";};','footer');
            Asset::add(secure_url('js/disqus.js'));
        }
        if ($post->isHL == 1)
        {
            Asset::add('https://cdn.roumen.it/repo/shl/styles/dark.css');
            Asset::add('https://cdn.roumen.it/repo/shl/scripts/default.js');
        }

        // get the view
        return view('post.view')->with('meta', $meta)->with('post', $post);
    }



    public function Search()
    {
        // get current language
        $lang = $this->getLang();

        // meta
        $meta['title'] = 'Search results';
        $meta['canonical'] = env('APP_URL').'blog/';
        $meta['robots'] = 'index,follow,noodp,noydir';
        $meta['description'] = 'Blog page';
        $meta['keywords'] = 'blog';

        // page assets
        Asset::add(secure_url('js/blog.js'));

        // get data from models
        $s = Input::get('s', 'post');
        $posts = Post::where('isVisible', '=', '1')->where('title', 'LIKE', "%$s%")
                                                   ->orWhere('content', 'LIKE', "%$s%")
                                                   ->orWhere('resume', 'LIKE', "%$s%")
                                                   ->orderBy('created_at', 'desc')->paginate(5);

        // check for problems
        $posts->setPath(secure_url('search')); // fix pagintor

        // get the view
        return view('post.search')->with('posts', $posts)->with('s', $s)->with('meta', $meta);
    }



        public function getEdit($id)
    {
        $post = Post::where('id','=',$id)->first();

        $meta['title'] = 'Edit post';

        $s1  = "$(function(){CKEDITOR.replace('post_content',{toolbar:'Standart',height:'400px',width:'760px',toolbarCanCollapse:true,toolbarStartupExpanded:true,startupShowBorders:true});});";
        $s1 .= "$(function(){CKEDITOR.replace('resume',{toolbar:'Standart',height:'100px',width:'760px',toolbarCanCollapse:true,toolbarStartupExpanded:true,startupShowBorders:true});});";
        $s2 = "$('#deleteBtn').click(function(){window.location = '".secure_url('/blog/del/'.$id)."';});";

        Asset::add('https://cdn.roumen.it/repo/ckeditor/4.4.6/basic/ckeditor.js');
        Asset::addScript($s1, 'ready');
        Asset::addScript($s2, 'ready');

        return view('post.edit')->with('meta', $meta)->with('post', $post);
    }



    public function postEdit($id)
    {
        $rules = array(
                'title'  => 'required|min:3|max:80',
                'slug' => 'required|min:3',
                'post_content'  => 'required|min:15',
                'resume'  => 'required|min:15',
                'description'  => 'required|min:10|max:180',
                'keywords' => 'required|min:3|max:90'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
                $data = array(
                   'title' => Input::get('title'),
                   'slug' => Input::get('slug'),
                   'content' => Input::get('post_content'),
                   'resume' => Input::get('resume'),
                   'description' => Input::get('description'),
                   'keywords' => Input::get('keywords'),
                   'robots' => Input::get('robots'),
                   'lang' => Input::get('lang'),
                   'isVisible' => Input::get('visible'),
                   'isHL' => Input::get('hl'),
                   'isDisqus' => Input::get('comments'),
                );

         Post::where('id','=',$id)->update($data);

         return Redirect::secure('blog/'.Input::get('slug'));

        }

        return Redirect::secure('blog/edit/'.$id)->withErrors($validation);
    }



    public function getCreate()
    {
        $meta['title'] = "Create post";

        $s1  = "$(function(){CKEDITOR.replace('post_content',{toolbar:'Standart',height:'400px',width:'760px',toolbarCanCollapse:true,toolbarStartupExpanded:true,startupShowBorders:true});});";
        $s1 .= "$(function(){CKEDITOR.replace('resume',{toolbar:'Standart',height:'100px',width:'760px',toolbarCanCollapse:true,toolbarStartupExpanded:true,startupShowBorders:true});});";

        Asset::add('https://cdn.roumen.it/repo/ckeditor/4.4.6/basic/ckeditor.js');
        Asset::addScript($s1, 'ready');

        return view('post.create')->with('meta', $meta);
    }



    public function postCreate()
    {
        $rules = array(
                'title'  => 'required|min:3|max:80',
                'slug' => 'required|min:3',
                'post_content'  => 'required|min:15',
                'resume'  => 'required|min:15',
                'description'  => 'required|min:10|max:180',
                'keywords' => 'required|min:3|max:90'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
                $data = array(
                   'title' => Input::get('title'),
                   'slug' => Input::get('slug'),
                   'content' => Input::get('post_content'),
                   'resume' => Input::get('resume'),
                   'description' => Input::get('description'),
                   'keywords' => Input::get('keywords'),
                   'robots' => Input::get('robots'),
                   'lang' => Input::get('lang'),
                   'isVisible' => Input::get('visible'),
                   'isHL' => Input::get('hl'),
                   'isDisqus' => Input::get('comments'),
                   'user_id' => Auth::user()->id
                );

         Post::insert($data);

         return Redirect::secure('/blog/'.Input::get('slug'));

        }

        return Redirect::secure('blog/add')->withErrors($validation);
    }



    public function getDelete($id)
    {
        $post = Post::where('id','=',$id)->first();

        $meta['title'] = 'DELETE: ' . $post->title;

        return view('post.delete')->with('meta', $meta)->with('post', $post);
    }



    public function postDelete($id)
    {
          if (Input::get('confirm')==true)
          {
              Post::where('id','=',$id)->delete();

              return Redirect::secure('/blog');
          }

          return Redirect::secure('blog/del/'.$id);
    }


}