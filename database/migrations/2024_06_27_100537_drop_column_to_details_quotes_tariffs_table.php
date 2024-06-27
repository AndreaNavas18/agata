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
        Schema::table('details_quotes_tariffs', function (Blueprint $table) {
            //
            $table->dropColumn('name_service');
            $table->dropColumn('bandwidth');
            $table->bigInteger('tariff_id')->nullable()->after('quote_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('details_quotes_tariffs', function (Blueprint $table) {
            //
            $table->string('name_service');
            $table->string('bandwidth');
            $table->dropColumn('tariff_id');
        });
    }
};
