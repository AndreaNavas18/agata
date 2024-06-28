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
            $table->string('observation')->nullable()->after('valor_total');

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
            $table->dropColumn('observation');
        });
    }
};