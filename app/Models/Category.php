<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function posts()
    {
        return $this->belongsToMany('App\Post', 'categories_to_posts', 'category_id', 'post_id')->orderBy('created_at','desc')->whereIn('isVisible', array('1','2'));
    }


}