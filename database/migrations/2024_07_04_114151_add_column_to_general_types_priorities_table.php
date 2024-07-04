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
        Schema::table('general_types_priorities', function (Blueprint $table) {
            $table->unsignedBigInteger('id_departament')->nullable()->after('id_ticket_priority');
            $table->foreign('id_departament')->references('id')->on('employees_positions_departments');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_types_priorities', function (Blueprint $table) {
            $table->dropForeign(['id_departament']);
            $table->dropColumn('id_departament');
        });
    }
};
