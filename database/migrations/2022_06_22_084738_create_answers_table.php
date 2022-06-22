<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('answers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('dream_id')->unsigned();
			$table->bigInteger('question_id')->unsigned();
			$table->text('answer');
		});
	}

	public function down()
	{
		Schema::drop('answers');
	}
};
