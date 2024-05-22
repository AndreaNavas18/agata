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

         // Cambiar el nombre del campo recurring_value a recurring_value_12
         $table->renameColumn('recurring_value', 'recurring_value_12');
            
         // Cambiar el nombre del campo value_Mbps a value_mbps_12
         $table->renameColumn('value_Mbps', 'value_mbps_12');
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
            $table->renameColumn('recurring_value_12', 'recurring_value');
            $table->renameColumn('value_mbps_12', 'value_Mbps');
        });
    }
};
