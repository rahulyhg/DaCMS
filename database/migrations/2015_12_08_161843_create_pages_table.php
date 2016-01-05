<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('slug', 200)->unique('slug');
			$table->string('title', 200);
			$table->text('content', 65535);
			$table->string('lang', 2);
			$table->boolean('isVisible');
			$table->string('description', 100);
			$table->string('keywords', 100);
			$table->string('robots', 40);
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
		Schema::drop('pages');
	}

}
