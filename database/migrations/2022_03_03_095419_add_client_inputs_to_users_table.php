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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable()->unique();
            $table->string('account_type')->default('individual'); // individual - company
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('image')->nullable();
            $table->string('id_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('account_type');
            $table->dropColumn('city_id');
            $table->dropColumn('image');
            $table->dropColumn('id_image');
        });
    }
};
