<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model
{

    protected $table = 'usergroups';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;


    public function users()
    {
      return $this->belongsToMany('App\User', 'users_to_usergroups', 'usergroup_id', 'user_id');
    }


}