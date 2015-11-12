<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

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



    public function posts()
    {
        return $this->hasMany('App\Post','user_id')->orderBy('created_at','desc');
    }


    public function usergroups()
    {
      return $this->belongsToMany('App\Usergroup', 'users_to_usergroups', 'user_id', 'usergroup_id');
    }


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


}