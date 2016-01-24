<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Validator;
use Redirect;

class Category extends Model
{

    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    /* relations */
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'categories_to_posts', 'category_id', 'post_id')->orderBy('created_at','desc')->whereIn('isVisible', array('1','2'));
    }

    /**
    * Update category
    *
    * @param $id int
    * @param $input array
    *
    * @return void
    */
    public static function updateCategory($id, $input)
    {
    	$rules = [
			'name'  => 'required|min:2|max:80',
			'slug' => 'required|min:2'
		];

		$validation = Validator::make($input, $rules);

		if ($validation->passes())
		{
			$data = [
			   'name' => $input['name'],
			   'slug' => $input['slug']
			];

		 	static::where('id','=',$id)->update($data);

		 	return Redirect::secure('category/'.$input['slug']);
		}

		return Redirect::secure('category/edit/'.$id)->withErrors($validation);
    }

    /**
    * Create category
    *
    * @param $input array
    *
    * @return void
    */
    public static function createCategory($input)
    {
    	$rules = [
			'name'  => 'required|min:2|max:80',
			'slug' => 'required|min:2'
		];

		$validation = Validator::make($input, $rules);

		if ($validation->passes())
		{
			$data = [
			   'name' => $input['name'],
			   'slug' => $input['slug']
			];

			static::insert($data);

			return Redirect::secure('/category/'.Input::get('slug'));

		}

		return Redirect::secure('category/add')->withErrors($validation);
    }

	/**
    * Delete category
    *
    * @param $id integer
    * @param $input array
    *
    * @return void
    */
    public static function deleteCategory($id, $input)
    {
    	if ($input['confirm'] == true)
		{
			static::where('id','=',$id)->delete();

		  	return Redirect::secure('/');
		}

		return Redirect::secure('category/del/'.$id);
    }

}