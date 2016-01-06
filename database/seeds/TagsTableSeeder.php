<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert(
        	[
	            'name' => 'DaCMS',
	            'slug' => 'dacms',
	            'id' => 1
        	],
        	[
	            'name' => 'Demo',
	            'slug' => 'demo',
	            'id' => 2
        	],
        	[
	            'name' => 'Laravel',
	            'slug' => 'laravel',
	            'id' => 3
        	],
        	[
	            'name' => 'Bootstrap',
	            'slug' => 'bootstrap',
	            'id' => 4
        	],
        );
    }
}
