<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up()
	{
		Schema::create('question_selects', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
            $table->unsignedBigInteger('question_id');
            $table->text('answer');
		});
	}

	public function down()
	{
		Schema::drop('question_selects');
	}
};
