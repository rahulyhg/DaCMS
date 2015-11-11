<?php namespace App\Http\Controllers;

use Auth;
use Redirect;
use App;
use App\Post;
use App\Tag;
use App\Category;
use Asset;
use Validator;
use Input;
use Purifier;
use Mail;
use Session;

class HomeController extends Controller
{


    public function __construct()
    {
        //$this->middleware('auth', ['only' => 'getLogout']);
    }



    public function getIndex()
    {

        Asset::add(secure_url('js/home.js'));

        $posts = Post::where('isVisible', '=', '1')->where('lang', '=', 'en')->orderBy('created_at', 'desc')->paginate(5);
        //$posts->setPath(secure_url('blog'));

        return view('home.index')->with('posts', $posts);
    }



    public function getLogin()
    {
        if (Auth::check()) { return Redirect::secure('/'); }

        $meta['title'] = 'Login form';
        $meta['canonical'] = env('APP_URL').'login';
        $meta['robots'] = 'noindex';

        return view('home.login')->with('meta', $meta);
    }



    public function postLogin()
    {
        $rules = array(
                'email'  => 'required|email',
                'password' => 'required|min:4',
                'g-recaptcha-response' => 'required|recaptcha'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
            $remember = (Input::has('remember')) ? true : false;

            if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password'), 'isActive' => 1], $remember))
            {
                return Redirect::secure('/');
            }
            else
            {
                return Redirect::secure('login')->withInput();
            }
        }
        else
        {
            return Redirect::secure('login')->withInput()->withErrors($validation);
        }
    }



    public function getLogout()
    {
        if (!Auth::check()) { return Redirect::secure('/'); }

        Auth::logout();
        return Redirect::secure('login');
    }



    public function getSitemap()
    {

        $sitemap = App::make("sitemap");

        $sitemap->setCache('dacms-sitemap', 1);

        if (!$sitemap->isCached())
        {

            $sitemap->add(secure_url('/'),'2015-11-12T20:00:00+02:00','1.0','weekly');
            $sitemap->add(secure_url('blog'),'2015-11-12T20:00:00+02:00','1.0','weekly');

            $posts = Post::whereIn('isVisible', array('1','2'))->orderBy('updated_at', 'desc')->get();
            //$pages = Page::whereIn('isVisible', array('1','2'))->orderBy('updated_at', 'desc')->get();
            $categories = Category::get();
            //$tags = Tag::get();

            foreach ($posts as $post)
            {
                $sitemap->add(secure_url('blog/'.$post->slug),date('Y-m-d\TH:i:sP',strtotime($post->updated_at)),'0.95','weekly');
            }

            foreach ($categories as $cat)
            {
                if (count($cat->posts) > 0)
                {
                    $latest = @date('Y-m-d\TH:i:sP',strtotime($cat->posts[0]->updated_at));
                    $sitemap->add(secure_url('category/'.$cat->slug), $latest, '0.35', 'weekly');
                }
            }

            /*
            foreach ($tags as $tag)
            {
                if (count($tag->posts) > 0)
                {
                    $latest = @date('Y-m-d\TH:i:sP',strtotime($tag->posts[0]->updated_at));
                    $sitemap->add(secure_url('tag/'.$tag->slug),$latest,'0.25','weekly');
                }
            }
            */

        }

        return $sitemap->render();
    }



    public function getFeed()
    {

        $feed = App::make("feed");

        $feed->setCache(180, 'dacms-feed');

        if (!$feed->isCached())
        {

            $posts = Post::where('isVisible','=','1')->orderBy('created_at', 'desc')->take(12)->get();

            $feed->title = 'Latest posts';
            $feed->description = 'DaCMS blog feed';
            $feed->link = env('APP_URL');
            $feed->logo = env('APP_URL') . 'favicon.png';
            $feed->icon = env('APP_URL') . 'favicon.png';
            $feed->pubdate = $posts[0]->created_at;
            $feed->lang = 'en';
            $feed->setDateFormat('datetime');

           foreach ($posts as $post)
            {
                $feed->add($post->title, 'DaCMS', secure_url('blog/'.$post->slug), $post->created_at, $post->resume, $post->content);
            }

        }

         return $feed->render('atom');

    }


}