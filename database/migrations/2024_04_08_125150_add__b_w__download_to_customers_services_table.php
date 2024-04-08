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
            $table->string('BW_Download')->nullable()->after('ancho_de_banda');
            $table->string('BW_upload')->nullable()->after('BW_Download');

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
            $table->dropColumn('BW_Download');
            $table->dropColumn('BW_upload');
        });
    }
};
