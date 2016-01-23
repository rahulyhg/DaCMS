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
use Config;

class HomeController extends Controller
{

	public function getContact()
	{
		// get the view
		return view('home.contact');
	}

	public function postContact()
	{
		$rules = [
			'name'  => 'required|min:2|max:50',
			'email' => 'required|email',
			'subject'  => 'required|min:2|max:50',
			'message'  => 'required|min:10',
			'g-recaptcha-response' => 'required|recaptcha'
		];

		$validation = Validator::make(Input::all(), $rules);

		if ($validation->passes())
		{
			// send e-mail
			$data = [
				'body'=> Purifier::clean(Input::get('message')),
				'subject'=> strip_tags(Purifier::clean(Input::get('subject'))),
				'name'=> strip_tags(Purifier::clean(Input::get('name'))),
				'email' => strip_tags(Purifier::clean(Input::get('email')))
			];

		   Mail::send('emails.contact', $data, function($message)
			{
				$message->from(Config::get('mail.username'), strip_tags(Purifier::clean(Input::get('name'))));
				$message->replyTo(strip_tags(Purifier::clean(Input::get('email'))), strip_tags(Purifier::clean(Input::get('name'))));
				$message->to(Config::get('mail.contactform'));
				$message->subject(strip_tags(Purifier::clean(Input::get('subject'))));
			});

			Session::flash('sended', 'true');

			return Redirect::secure('contact')->withInput();
		}
		else
		{
			return Redirect::secure('contact')->withInput()->withErrors($validation);
		}
	}


	public function getSitemap()
	{

		$sitemap = App::make("sitemap");

		$sitemap->setCache('dacms-sitemap', 180);

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
			$feed->link = Config::get('app.url');
			$feed->logo = Config::get('app.url') . '/favicon.png';
			$feed->icon = Config::get('app.url') . '/favicon.png';
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