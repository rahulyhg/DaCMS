<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Config;
use Validator;
use Redirect;

class Tag extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

    /* relations */
    public function posts()
    {
      return $this->belongsToMany('App\Post', 'tags_to_posts', 'tag_id', 'post_id')->whereIn('isVisible', array('1','2'))->orderBy('created_at','desc');
    }

    /**
    * Update tag
    *
    * @param $id int
    * @param $input array
    *
    * @return void
    */
    public static function updateTag($id, $input)
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

            return Redirect::secure('tag/'.$input['slug']);
        }

        return Redirect::secure('tag/edit/'.$id)->withErrors($validation);
    }

    /**
    * Create tag
    *
    * @param $input array
    *
    * @return void
    */
    public static function createTag($input)
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

            return Redirect::secure('/tag/'.Input::get('slug'));

        }

        return Redirect::secure('tag/add')->withErrors($validation);
    }

    /**
    * Delete tag
    *
    * @param $id integer
    * @param $input array
    *
    * @return void
    */
    public static function deleteTag($id, $input)
    {
        if ($input['confirm'] == true)
        {
            static::where('id','=',$id)->delete();

            return Redirect::secure('/');
        }

        return Redirect::secure('tag/del/'.$id);
    }
}
