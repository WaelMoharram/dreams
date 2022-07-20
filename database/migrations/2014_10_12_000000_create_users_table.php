<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->nullable();
            $table->string('mobile')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->date('birthdate');
            $table->string('job');
            $table->boolean('gender');

            $table->integer('sms_code')->nullable();
            $table->string('password');
            $table->string('status')->default('new');
            $table->boolean('notification_status')->default(1);
            $table->string('type')->default('admin');
            $table->text('api_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();


            //

            $table->integer('experience_years')->default(0);
            $table->string('note')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
