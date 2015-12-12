<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;

class Tag extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;


    public function posts()
    {
      return $this->belongsToMany('App\Post', 'tags_to_posts', 'tag_id', 'post_id')->whereIn('isVisible', array('1','2'))->orderBy('created_at','desc');
    }



}
