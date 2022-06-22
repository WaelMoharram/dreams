<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('dream_id');
			$table->bigInteger('user_id')->unsigned();
			$table->text('message');
		});
	}

	public function down()
	{
		Schema::drop('messages');
	}
};
