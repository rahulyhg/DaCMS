<?php namespace App\Http\Controllers;

use Auth;
use Redirect;
use App;
use App\Post;
use App\Tag;
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

        $lang = $this->getLang();

        if ($lang == 'bg')
        {
            $meta['title'] = 'Логин форма | Roumen.IT';
            $meta['canonical'] = 'https://roumen.it/login';
            $meta['robots'] = 'noindex';
            $meta['description'] = 'Логин форма за вход.';
            $meta['keywords'] = 'login form, логин форма';
        } else
            {
                $meta['title'] = 'Login form | Roumen.IT';
                $meta['canonical'] = 'https://roumen.it/login';
                $meta['robots'] = 'noindex';
                $meta['description'] = 'Login form.';
                $meta['keywords'] = 'login form';
            }

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




}