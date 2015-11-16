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
use Hash;
use Validator;
use Input;
use Purifier;
use Mail;
use Session;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getIndex','getView','getLogin','postLogin','getLogout']]);
        $this->middleware('moderator', ['except' => ['getIndex','getView','getLogin','postLogin','getLogout','getDashboard']]);
    }



    public function getView($id)
    {
        $user = User::where('id','=', $id)->first();
        if (empty($user)) return view('errors.404'); // not found

        // meta
        $meta['title'] = 'Profile of user: '.$user->username;
        $meta['canonical'] = env('APP_URL').'user/'.$id;
        $meta['description'] = 'Profile of user: '.$user->username;
        $meta['keywords'] = ''.$user->username;

        // view
        return view('user.view')->with('meta', $meta)->with('user', $user);
    }


 public function getEdit($id)
    {
        $user = User::where('id','=',$id)->first();

        $meta['title'] = 'Edit user';

        $s1 = "$('#deleteBtn').click(function(){window.location = '".secure_url('/user/del/'.$id)."';});";

        Asset::addScript($s1, 'ready');

        return view('user.edit')->with('meta', $meta)->with('user', $user);
    }



    public function postEdit($id)
    {
        $rules = array(
                'username'  => 'required|min:3|max:20',
                //'password' => 'required|min:3',
                'email'  => 'required|min:5',
                'first_name'  => 'required|min:2|max:60',
                'first_name' => 'required|min:2|max:60'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
                $data = array(
                   'username' => Input::get('username'),
                   //'password' => Input::get('password'),
                   'email' => Input::get('email'),
                   'first_name' => Input::get('first_name'),
                   'last_name' => Input::get('last_name'),
                   'isActive' => Input::get('isActive')
                );

         User::where('id','=',$id)->update($data);

         \DB::table('users_to_usergroups')->where('user_id','=',$id)->update(['usergroup_id'=>Input::get('usergroup')]);

        }

        return Redirect::secure('user/edit/'.$id)->withErrors($validation);
    }



    public function getCreate()
    {
        $meta['title'] = "Create user";

        return view('user.create')->with('meta', $meta);
    }



    public function postCreate()
    {
        $rules = array(
                'username'  => 'required|min:3|max:20',
                'password' => 'required|min:3',
                'email'  => 'required|min:5',
                'first_name'  => 'required|min:2|max:60',
                'first_name' => 'required|min:2|max:60'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
                $data = [
                   'username' => Input::get('username'),
                   'password' => Hash::make(Input::get('password')), // hash the password
                   'email' => Input::get('email'),
                   'first_name' => Input::get('first_name'),
                   'last_name' => Input::get('last_name'),
                   'isActive' => Input::get('isActive')
                ];

         $id = User::insertGetId($data);

         \DB::table('users_to_usergroups')->insert(['user_id'=>$id,'usergroup_id'=>Input::get('usergroup')]);

         return Redirect::secure('/'.Input::get('slug'));

        }

        return Redirect::secure('user/add')->withErrors($validation);
    }



    public function getDelete($id)
    {
        $user = User::where('id','=',$id)->first();

        $meta['title'] = 'DELETE: ' . $user->title;

        return view('user.delete')->with('meta', $meta)->with('user', $user);
    }



    public function postDelete($id)
    {
          if (Input::get('confirm')==true)
          {
              User::where('id','=',$id)->delete();

              \DB::table('users_to_usergroups')->where('user_id','=',$id)->delete();

              return Redirect::secure('/');
          }

          return Redirect::secure('user/del/'.$id);
    }



    public function getDashboard()
    {
        // check if user is logged in
        if (!Auth::check()) return Redirect::secure('/login');

        // data
        $user = User::where('id', '=', Auth::user()->id)->first();

        // meta
        $meta['title'] = 'Dashboard';
        $meta['canonical'] = env('APP_URL').'dashboard';
        $meta['description'] = '';
        $meta['keywords'] = '';

        // assets
        Asset::add(secure_url('js/home.js'));

        // return view
        return view('user.dashboard')->with('meta', $meta)->with('user', $user);
    }



    public function getLogin()
    {
        if (Auth::check()) return Redirect::secure('/');

        $meta['title'] = 'Login form';
        $meta['canonical'] = env('APP_URL').'login';
        $meta['robots'] = 'noindex';

        return view('user.login')->with('meta', $meta);
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
        if (!Auth::check()) return Redirect::secure('/');

        Auth::logout();

        return Redirect::secure('login');
    }


}