<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('equipment_user_id');
            $table->integer('days');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('order_time');
            $table->string('mobile');
            $table->unsignedBigInteger('city_id');
            $table->decimal('lat');
            $table->decimal('lng');
            $table->text('info')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('new');
            $table->string('type'); //rent - transportation
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
