<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
   		Model::unguard();

    	$this->call(UsersTableSeeder::class);
    	$this->call(UsergroupsTableSeeder::class);
    	$this->call(TagsTableSeeder::class);
    	$this->call(CategoriesTableSeeder::class);
    	$this->call(PagesTableSeeder::class);
    	$this->call(PostsTableSeeder::class);

    	Model::reguard();
	}

}
