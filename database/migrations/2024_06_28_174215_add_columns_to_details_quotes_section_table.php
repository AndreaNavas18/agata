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
        Schema::table('details_quotes_section', function (Blueprint $table) {
            //
            $table->string('service_id')->nullable()->after('quote_id');
            $table->dropColumn('name_service');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('details_quotes_section', function (Blueprint $table) {
            //
            $table->string('name_service')->nullable();
            $table->dropColumn('service_id');
        });
    }
};
