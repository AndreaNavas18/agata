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
        Schema::table('commercial_tariffs', function (Blueprint $table) {
            // agregar nuevos campos recurring_value_24 y recurring_value_36
            $table->bigInteger('recurring_value_24')->after('recurring_value_12')->nullable();
            $table->bigInteger('recurring_value_36')->after('recurring_value_24')->nullable();
            
            // Agregar nuevos campos value_mbps_24 y value_mbps_36
            $table->bigInteger('value_mbps_24')->after('value_mbps_12')->nullable();
            $table->bigInteger('value_mbps_36')->after('value_mbps_24')->nullable();
            
            // Eliminar el campo months
            $table->dropColumn('months');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commercial_tariffs', function (Blueprint $table) {
            // Revertir los cambios en el método down
            $table->dropColumn('recurring_value_24');
            $table->dropColumn('recurring_value_36');
            $table->dropColumn('value_mbps_24');
            $table->dropColumn('value_mbps_36');
            $table->integer('months');
        });
    }
};
