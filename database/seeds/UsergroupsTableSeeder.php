<?php

use Illuminate\Database\Seeder;

class UsergroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usergroups')->insert(
        	[
	            'name' => 'admins',
	            'id' => 1
        	],
        	[
	            'name' => 'moderators',
	            'id' => 2
        	],
        	[
	            'name' => 'editors',
	            'id' => 3
        	],
        	[
	            'name' => 'users',
	            'id' => 4
        	],
        );
    }
}
