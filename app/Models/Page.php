<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Validator;
use Redirect;

class Page extends Model
{

    protected $table = 'pages';
    public $timestamps = false;
    public $incrementing = false;

    /* relations */
    public function author()
    {
        return $this->belongsTo('App\User','user_id');
    }

    /**
    * Update page
    *
    * @param $id int
    * @param $input array
    *
    * @return void
    */
    public static function updatePage($id, $input)
    {
    	$rules = [
			'title'  => 'required|min:3|max:80',
			'slug' => 'required|min:3',
			'content'  => 'required|min:15',
			'description'  => 'required|min:10|max:180',
			'keywords' => 'required|min:3|max:90'
		];

		$validation = Validator::make($input, $rules);

		if ($validation->passes())
		{
			$data = [
			   'title' => $input['title'],
			   'slug' => $input['slug'],
			   'content' => $input['content'],
			   'description' => $input['description'],
			   'keywords' => $input['keywords'],
			   'robots' => $input['robots'],
			   'lang' => $input['lang']
			];

		 	static::where('id','=',$id)->update($data);

		 	return Redirect::secure('/'.$input['slug']);

		}

		return Redirect::secure('page/edit/'.$id)->withErrors($validation);
    }


    /**
    * Create page
    *
    * @param $input array
    *
    * @return void
    */
    public static function createPage($input)
    {
		$rules = [
			'title'  => 'required|min:3|max:80',
			'slug' => 'required|min:3',
			'content'  => 'required|min:15',
			'description'  => 'required|min:10|max:180',
			'keywords' => 'required|min:3|max:90'
		];

		$validation = Validator::make($input, $rules);

		if ($validation->passes())
		{
			$data = [
			   'title' => $input['title'],
			   'slug' => $input['slug'],
			   'content' => $input['content'],
			   'description' => $input['description'],
			   'keywords' => $input['keywords'],
			   'robots' => $input['robots'],
			   'lang' => $input['lang'],
			   'user_id' => $input['user_id']
			];

		 	static::insert($data);

		 	return Redirect::secure('/'.Input::get('slug'));
		}

		return Redirect::secure('page/add')->withErrors($validation);
    }


	/**
    * Delete page
    *
    * @param $id integer
    * @param $input array
    *
    * @return void
    */
    public static function deletePage($id, $input)
    {
        // if deleting is confirmed
        if ($input['confirm'] == true)
        {
            // delete post
            static::where('id','=',$id)->delete();

            return Redirect::secure('/');
        }

        return Redirect::secure('page/del/'.$id);
    }

}