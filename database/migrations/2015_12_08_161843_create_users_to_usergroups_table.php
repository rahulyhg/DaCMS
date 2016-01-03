<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersToUsergroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_to_usergroups', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->integer('usergroup_id');
			$table->unique(['user_id','usergroup_id'], 'user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_to_usergroups');
	}

}
