<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;



    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tags_to_posts', 'post_id', 'tag_id');

    }



    public function categories()
    {
        return $this->belongsToMany('App\Category', 'categories_to_posts', 'post_id', 'category_id');
    }



    public function user()
    {
        $this->primaryKey = 'id';
        return $this->belongsTo('App\User');
    }



    public function lcomments()
    {
        return $this->hasMany('App\Comment','slug');
    }


}