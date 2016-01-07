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
        DB::table('usergroups')->insert([
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
        ]);

        // users to usergroups
        DB::table('users_to_usergroups')->insert([
        	[
	            'user_id' => 1,
	            'usergroup_id' => 1,
        	],
        	[
	            'user_id' => 2,
	            'usergroup_id' => 4,
        	]
        ]);
    }
}
