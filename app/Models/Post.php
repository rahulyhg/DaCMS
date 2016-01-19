<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Validator;
use Redirect;

class Post extends Model
{

    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;


    /* relations */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tags_to_posts', 'post_id', 'tag_id');

    }


    public function categories()
    {
        return $this->belongsToMany('App\Category', 'categories_to_posts', 'post_id', 'category_id');
    }


    public function author()
    {
        return $this->belongsTo('App\User','user_id');
    }


    public function lcomments()
    {
        return $this->hasMany('App\Comment','slug');
    }


    /**
    * Update post
    *
    * @param $input array
    *
    * @return void
    */
    public static function updatePost($id, $input)
    {
        $rules = [
                'title'  => 'required|min:3|max:80',
                'slug' => 'required|min:3',
                'post_content'  => 'required|min:15',
                'resume'  => 'required|min:15',
                'description'  => 'required|min:10|max:180',
                'keywords' => 'required|min:3|max:90'
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $data = [
               'title' => $input['title'],
               'slug' => $input['slug'],
               'content' => $input['post_content'],
               'resume' => $input['resume'],
               'description' => $input['description'],
               'keywords' => $input['keywords'],
               'robots' => $input['robots'],
               'lang' => $input['lang'],
               'isVisible' => $input['visible'],
               'isHL' => $input['hl'],
               'isDisqus' => $input['comments'],
            ];

            // update post
            self::where('id','=',$id)->update($data);

            // redirect to post
            return Redirect::secure('blog/'.$input['slug']);
        }

        // redirect to edit page with errors
        return Redirect::secure('blog/edit/'.$id)->withErrors($validation);
    }


    /**
    * Create new post
    *
    * @param $input array
    *
    * @return void
    */
    public static function createPost($input)
    {
        $rules = [
                'title'  => 'required|min:3|max:80',
                'slug' => 'required|min:3',
                'post_content'  => 'required|min:15',
                'resume'  => 'required|min:15',
                'description'  => 'required|min:10|max:180',
                'keywords' => 'required|min:3|max:90'
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->passes())
        {
            $data = [
               'title' => $input['title'],
               'slug' => $input['slug'],
               'content' => $input['post_content'],
               'resume' => $input['resume'],
               'description' => $input['description'],
               'keywords' => $input['keywords'],
               'robots' => $input['robots'],
               'lang' => $input['lang'],
               'isVisible' => $input['visible'],
               'isHL' => $input['hl'],
               'isDisqus' => $input['comments'],
               'user_id' => $input['user_id']
            ];

            self::insert($data);

            return Redirect::secure('/blog/'.$input['slug']);
        }

        return Redirect::secure('blog/add')->withErrors($validation);
    }


    /**
    * Delete post by $id
    *
    * @param $input array
    *
    * @return void
    */
    public static function deletePost($id, $input)
    {
        // if deleting is confirmed
        if ($input['confirm'] == true)
        {
            // delete post
            self::where('id','=',$id)->delete();

            return Redirect::secure('/blog');
        }

        return Redirect::secure('blog/del/'.$id);
    }


}