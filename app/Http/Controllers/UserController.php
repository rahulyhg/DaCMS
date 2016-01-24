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
use Config;

class UserController extends Controller
{

	public function getView($id)
	{
		// get user by id
		$user = User::where('id','=', $id)->with('posts')->first();

		// missing user
		if (empty($user)) return abort('404');

		// view
		return view('user.view', ['user'=>$user]);
	}

	public function getUpdate($id)
	{
		// get user to update
		$user = User::where('id','=',$id)->first();

		// view
		return view('user.update', ['user' => $user]);
	}

	public function postUpdate($id)
	{
		// update user
		return User::updateUser($id, Input::all());
	}

	public function getCreate()
	{
		// view
		return view('user.create');
	}

	public function postCreate()
	{
		// create new user
		return User::createUser(Input::all());
	}

	public function getDelete($id)
	{
		// get user to delete
		$user = User::where('id','=',$id)->first();

		// view
		return view('user.delete', ['user' => $user]);
	}

	public function postDelete($id)
	{
		// delete user
		return User::deleteUser($id,Input::all());
	}

	public function getDashboard()
	{
		// data
		$user = User::where('id', '=', $this->authUser->id)->first();

		// assets
		Asset::add(secure_url('js/home.js'));

		// return view
		return view('user.dashboard', ['user' => $user]);
	}

	public function getLogin()
	{
		// check for login
		if (Auth::check()) return Redirect::secure('/');

		// view
		return view('user.login');
	}

	public function postLogin()
	{
		$rules = [
				'email'  => 'required|email',
				'password' => 'required|min:4',
				'g-recaptcha-response' => 'required|recaptcha'
		];

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