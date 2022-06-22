<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquipmentUserTable extends Migration {

	public function up()
	{
		Schema::create('equipment_user', function(Blueprint $table) {
			$table->increments('id');
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('note');
            $table->string('image');
            $table->string('for'); // sell - rent
            $table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('equipment_user');
	}
}
