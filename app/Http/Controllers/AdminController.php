<?php namespace App\Http\Controllers;

use App;
use Auth;
use Redirect;
use Session;
use Validator;
use Input;
use Disqus;
use Config;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function getIndex()
    {
        $meta['title'] = 'Admin panel';
        $meta['canonical'] = secure_url('admin');
        $meta['robots'] = 'noindex';
        $meta['description'] = 'Admin panel';

        return view('admin.index')->with('meta', $meta)->with('siteUpdated', Session::get('siteUpdated'));
    }


    public function getUpdate()
    {
        $status = shell_exec('sh -x update.sh');

        Session::put('siteUpdated', $status);

        return Redirect::secure('admin');
    }


    public function getSync()
    {
        // get disqus
        require_once(base_path().'/config/_private.php');

        $meta['title'] = 'Disqus sync';

        $disqus = new Disqus(getDisqusKey());
        $disqus->setSecure(false);

        $since = str_replace(' ', 'T', \DB::table('comments')->max('date')); // fix time format

        $params = array('forum'=>'roumen','limit'=>51,'order'=>'asc','include'=>'approved','related'=>'thread','since'=>$since);

        $comments = $disqus->posts->list($params);

        return view('admin.sync')->with('comments', $comments)->with('meta', $meta);
    }


}