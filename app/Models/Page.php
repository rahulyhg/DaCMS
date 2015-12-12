<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $table = 'pages';
    public $timestamps = false;
    public $incrementing = false;


    public function user()
    {
         return $this->belongsTo('App\User');
    }

}