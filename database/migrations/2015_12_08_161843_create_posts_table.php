<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('title', 80);
			$table->string('slug', 200)->index('slug');
			$table->text('resume', 16777215);
			$table->text('content');
			$table->boolean('isVisible');
			$table->boolean('isPublished');
			$table->boolean('isHL');
			$table->boolean('isDisqus');
			$table->string('description', 200);
			$table->string('keywords', 100);
			$table->string('robots', 20);
			$table->string('lang', 2);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
