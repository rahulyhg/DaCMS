<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Validator;
use Redirect;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}


	/* relations */
    public function posts()
    {
        return $this->hasMany('App\Post','user_id')->orderBy('created_at','desc');
    }


    /**
    * Update user
    *
    * @param $id int
    * @param $input array
    *
    * @return void
    */
    public static function updateUser($id, $input)
    {
        $rules = [
            'username'  => 'required|min:3|max:20',
            //'password' => 'required|min:3',
            'email'  => 'required|min:5',
            'first_name'  => 'required|min:2|max:60',
            'first_name' => 'required|min:2|max:60'
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
                $data = [
                   'username' => $input['username'],
                   //'password' => $input['password'],
                   'email' => $input['email'],
                   'first_name' => $input['first_name'],
                   'last_name' => $input['last_name'],
                   'isActive' => $input['isActive'],
                   'role' => $input['role']
                ];

         static::where('id','=',$id)->update($data);

         return Redirect::secure('user/'.$id);

        }

        return Redirect::secure('user/edit/'.$id)->withErrors($validation);
    }


    /**
    * Create user
    *
    * @param $input array
    *
    * @return void
    */
    public static function createUser($input)
    {
        $rules = [
            'username'  => 'required|min:3|max:20',
            'password' => 'required|min:3',
            'email'  => 'required|min:5',
            'first_name'  => 'required|min:2|max:60',
            'first_name' => 'required|min:2|max:60'
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $data = [
               'username' => $input['username'],
               'password' => Hash::make($input['password']), // hash the password
               'email' => $input['email'],
               'first_name' => $input['first_name'],
               'last_name' => $input['last_name'],
               'isActive' => $input['isActive'],
               'role' => $input['role']
            ];

         $id = static::insertGetId($data);

         return Redirect::secure('/user/'.$input['id']);

        }

        return Redirect::secure('user/add')->withErrors($validation);
    }


	/**
    * Delete user
    *
    * @param $id integer
    * @param $input array
    *
    * @return void
    */
    public static function deleteUser($id, $input)
    {
        if ($input['confirm'] == true)
        {
            static::where('id','=',$id)->delete();

            return Redirect::secure('/');
        }

        return Redirect::secure('user/del/'.$id)->withErrors($validation);
    }


}