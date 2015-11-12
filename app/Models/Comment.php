<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';
    protected $primaryKey = 'slug';
    public $timestamps = false;


    public function post()
    {
        return $this->belongsTo('App\Post','slug');
    }


    public function project()
    {
        return $this->belongsTo('App\Project','slug');
    }

}