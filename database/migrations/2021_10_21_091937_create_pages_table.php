<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	public function up()
	{
		Schema::create('pages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('title');
			$table->text('content');
		});
	}

	public function down()
	{
		Schema::drop('pages');
	}
}