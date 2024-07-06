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
            $table->string('stratecsa_id')->nullable()->after('id');
            $table->string('id_serviciocliente')->nullable()->after('stratecsa_id');
            $table->string('otp')->nullable()->after('id_serviciocliente');

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
            $table->dropColumn('stratecsa_id');
            $table->dropColumn('id_serviciocliente');
            $table->dropColumn('otp');
        });
    }
};
