<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up()
	{
		Schema::create('sliders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
            $table->text('title');
            $table->text('image');
		});
	}

	public function down()
	{
		Schema::drop('sliders');
	}
};
