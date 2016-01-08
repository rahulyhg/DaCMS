<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('categories')->insert([
        	[
	            'name' => 'General',
	            'slug' => 'general',
	            'id' => 1
        	],
        	[
	            'name' => 'News',
	            'slug' => 'news',
	            'id' => 2
        	],
        	[
	            'name' => 'Reviews',
	            'slug' => 'reviews',
	            'id' => 3
        	],
        	[
	            'name' => 'Tutorials',
	            'slug' => 'tutorials',
	            'id' => 4
        	],
        	[
	            'name' => 'Videos',
	            'slug' => 'videos',
	            'id' => 5
        	],
        	[
	            'name' => 'Pictures',
	            'slug' => 'pictures',
	            'id' => 6
        	],
        ]);
    }
}
