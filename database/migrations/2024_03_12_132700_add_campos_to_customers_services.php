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
            
            $table->string('ip')->nullable()->after('state');
            $table->string('vlan')->nullable()->after('ip');
            $table->string('mascara')->nullable()->after('vlan');
            $table->string('gateway')->nullable()->after('mascara');
            $table->string('mac')->nullable()->after('gateway');
            $table->string('ancho_de_banda')->nullable()->after('mac');
            $table->string('ip_vpn')->nullable()->after('ancho_de_banda');
            $table->string('tipo_vpn')->nullable()->after('ip_vpn');
            $table->string('user_vpn')->nullable()->after('tipo_vpn');
            $table->string('password_vpn')->nullable()->after('user_vpn');
            $table->string('user_tunel')->nullable()->after('password_vpn');
            $table->string('id_tunel')->nullable()->after('user_tunel');
            $table->string('tecnologia')->nullable()->after('id_tunel');
            $table->string('equipo')->nullable()->after('tecnologia');
            $table->string('modelo')->nullable()->after('equipo');
            $table->string('serial')->nullable()->after('modelo');
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
            $table->dropColumn('ip');
            $table->dropColumn('vlan');
            $table->dropColumn('mascara');
            $table->dropColumn('gateway');
            $table->dropColumn('mac');
            $table->dropColumn('ancho_de_banda');
            $table->dropColumn('ip_vpn');
            $table->dropColumn('tipo_vpn');
            $table->dropColumn('user_vpn');
            $table->dropColumn('password_vpn');
            $table->dropColumn('user_tunel');
            $table->dropColumn('id_tunel');
            $table->dropColumn('tecnologia');
            $table->dropColumn('equipo');
            $table->dropColumn('modelo');
            $table->dropColumn('serial');

        });
    }
};
