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
        Schema::table('customers_services', function (Blueprint $table) {
            //
            $table->string('otp')->nullable()->after('stratecsa_id');
            $table->string('id_serviciocliente')->nullable()->after('stratecsa_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers_services', function (Blueprint $table) {
            //
            $table->dropColumn('OTP');
            $table->dropColumn('id_serviciocliente');
        });
    }
};
