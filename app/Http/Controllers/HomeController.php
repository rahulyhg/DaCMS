<?php namespace App\Http\Controllers;

use Auth;
use Redirect;
use App;
use App\Post;
use App\Tag;
use App\Category;
use App\User;
use App\Usergroup;
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
        $this->middleware('auth', ['only' => 'getDisqus2db']);
    }



    public function getContact()
    {
        // todo
    }


    public function postContact()
    {
        // todo
    }



    public function getDisqus2db()
    {
        // todo
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
            $tags = Tag::get();

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

            foreach ($tags as $tag)
            {
                if (count($tag->posts) > 0)
                {
                    $latest = @date('Y-m-d\TH:i:sP',strtotime($tag->posts[0]->updated_at));
                    $sitemap->add(secure_url('tag/'.$tag->slug),$latest,'0.25','weekly');
                }
            }

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