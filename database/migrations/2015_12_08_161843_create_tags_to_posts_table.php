<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsToPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags_to_posts', function(Blueprint $table)
		{
			$table->integer('tag_id');
			$table->integer('post_id');
			$table->unique(['tag_id','post_id'], 'tag_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags_to_posts');
	}

}
