<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
	            'username' => 'admin',
	            'email' => 'admin@dacms.co',
	            'password' => bcrypt('admin'),
	            'first_name' => 'Admin',
	            'last_name' => 'Adminoff',
	            'isActive' => 1,
	            'id' => 1
        	],
        	[
	            'username' => 'demo',
	            'email' => 'demo@dacms.co',
	            'password' => bcrypt('demo'),
	            'first_name' => 'Demo',
	            'last_name' => 'Demoff',
	            'isActive' => 1,
	            'id' => 2
        	],
        ]);
    }
}
