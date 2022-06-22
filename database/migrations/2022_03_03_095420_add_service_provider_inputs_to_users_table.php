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
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_iban')->nullable();
            $table->boolean('transportation_services')->default(0);
            $table->boolean('rent_services')->default(0);
            $table->boolean('sell_services')->default(0);
            $table->string('driving_license_image')->nullable();
            $table->string('working_license_image')->nullable();
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
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_account_number');
            $table->dropColumn('bank_iban');
            $table->dropColumn('transportation_services');
            $table->dropColumn('rent_services');
            $table->dropColumn('sell_services');
            $table->dropColumn('driving_license_image');
            $table->dropColumn('working_license_image');
        });
    }
};
