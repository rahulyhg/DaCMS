<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
        	[
	            'id' => 1,
	            'user_id' => 1,
	            'slug' => 'home',
	            'title' => 'Homepage',
	            'lang' => 'en',
	            'isVisible' => 1,
	            'description' => 'DaCMS example homepage.',
	            'keywords' => 'DaCMS, demo, homepage',
	            'robots' => 'all',
	            'content' => '<p><strong>This is just a demo homepage.</strong></p> <p><em>More info about DaCMS: </em><a href="https://github.com/DaCMS/DaCMS">@GitHub</a>.</p>'
        	],
        	[
	            'id' => 2,
	            'user_id' => 1,
	            'slug' => 'about',
	            'title' => 'About',
	            'lang' => 'en',
	            'isVisible' => 1,
	            'description' => 'DaCMS example about page.',
	            'keywords' => 'DaCMS, demo, about',
	            'robots' => 'all',
	            'content' => '<p><strong>This is just a demo about page.</strong></p> <p><em>More info about DaCMS: </em><a href="https://github.com/DaCMS/DaCMS">@GitHub</a>.</p>'
        	],
        	]);
    }
}
