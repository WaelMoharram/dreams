<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDevicesTokenTable extends Migration {

    public function up() {
        Schema::create('user_devices_token', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("user_id")->nullable();
            $table->string("token")->nullable();
        });
    }
    public function down() {
        Schema::dropIfExists("user_devices_token");
    }
}
