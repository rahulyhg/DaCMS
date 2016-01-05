<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesToPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories_to_posts', function(Blueprint $table)
		{
			$table->integer('category_id');
			$table->integer('post_id');
			$table->unique(['category_id','post_id'], 'category_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories_to_posts');
	}

}
