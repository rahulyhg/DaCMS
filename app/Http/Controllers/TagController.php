<?php namespace App\Http\Controllers;

use App;
use App\Tag;
use Auth;
use Redirect;
use Validator;
use Input;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getIndex', 'getView']]);
        $this->middleware('admin', ['except' => ['getIndex','getView']]);
    }

    public function getIndex()
    {
        $meta['title'] = 'Tag list | Roumen.IT';
        $meta['canonical'] = 'http://roumen.it/tag';
        $meta['keywords'] = 'tag list, tags';
        $meta['description'] = 'List of all popular tags that have been used in this website.';
        $meta['robots'] = 'noindex';

        return view('tag.index')->with('meta', $meta)->with('tags', Tag::get());
    }

    public function getView($slug=null)
    {

        $tag = Tag::where('slug','=',$slug)->first();
        if (empty($tag)) return view('errors.404');

        $lang = $this->getLang();

        $posts = $tag->posts;

        if ($lang=='bg')
        {
            $meta['description'] = 'Списък на всички постове и проекти с таг: ' . $tag->name;
        } else
            {
                $meta['description'] = 'List of posts and projects with tag: ' . $tag->name;

            }

            $meta['title'] = 'Tag: ' . $tag->name . ' | Roumen.IT';
            $meta['canonical'] = 'https://roumen.it/tag/' . $tag->slug;
            $meta['keywords'] = 'tag, ' . $tag->slug;
            $meta['robots'] = 'index,follow';

        return view('tag.view')->with('meta', $meta)->with('tag', $tag)->with('posts', $posts);
    }

    // TODO: convert to laravel!
    public function getEdit($id)
    {
        if (!Auth::check()) { return Redirect::secure('/login'); }

        if($this->session->userdata('role') > 7)
        {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Tag','required|min_length[2]|max_length[40]');
            $this->form_validation->set_rules('slug','Slug','required|min_length[2]');

            if ($this->form_validation->run() != false)
            {
               // update values
                $data = array(
                   'name' => $this->input->post('name'),
                   'slug' => $this->input->post('slug')
                );

                $this->db->where('id', $id);
                $this->db->update('tags', $data);

            }

            $this->load->model('tag_model');
            $tag = $this->tag_model->get_single_by_id($id);

            $this->layout->title = 'Tag: ' . $tag->name .' | Roumen.IT';
            $this->layout->canonical = 'http://roumen.it/tag/'.$tag->slug;
            $this->layout->keywords = 'roumen damianoff, tag, '.$tag->slug;
            $this->layout->description = 'Tag: ' . $tag->slug;

            $this->layout->js_footer[] = base_url('js/edit.js');

            $this->layout->render('tag/edit',$tag);

        } else { redirect('/'); }

    }


    // TODO: convert to laravel!
    public function getCreate()
    {
        if (!Auth::check()) { return Redirect::secure('/login'); }

        if($this->session->userdata('role') > 7)
        {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Tag','required|min_length[2]|max_length[40]');
            $this->form_validation->set_rules('slug','Slug','required|min_length[2]');

            if ($this->form_validation->run() != false)
            {
               // update values
                $data = array(
                   'name' => $this->input->post('name'),
                   'slug' => $this->input->post('slug')
                );

                $this->db->insert('tags', $data);
                redirect('/tag/'.$this->input->post('slug'));

            }

            $this->layout->title = 'Create new Tag | Roumen.IT';
            $this->layout->canonical = 'http://roumen.it/tag/add';
            $this->layout->keywords = 'roumen damianoff, create new tag';
            $this->layout->description = 'Create new Tag';
            $this->layout->robots = 'noindex';

            $this->layout->js_footer[] = base_url('js/edit.js');

            $this->layout->render('tag/create');

        } else { redirect('/'); }

    }

    // TODO: convert to laravel!
    public function getDelete($id,$confirm=0)
    {
        if (!Auth::check()) { return Redirect::secure('/login'); }

        if($this->session->userdata('role') > 7)
        {
            if ($confirm == 1)
            {
                $this->db->where('id',$id)->delete('tags');
                redirect('/');
            } else {

                $data['id']=$id;
                $this->load->view('tag/delete',$data);
            }
        }
    }


}