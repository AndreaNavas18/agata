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
        Schema::table('commercial_bandwidths', function (Blueprint $table) {
            //
            $table->bigInteger('department_id')->nullable()->after('name');
            $table->bigInteger('city_id')->nullable()->after('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commercial_bandwidths', function (Blueprint $table) {
            //
            $table->dropColumn('department_id');
            $table->dropColumn('city_id');
        });
    }
};
