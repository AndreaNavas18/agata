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
        Schema::table('pqrs', function (Blueprint $table) {
            $table->string('tema_id')->nullable()->after('department_id');
            $table->string('service_id')->nullable()->after('tema_id');
            $table->string('provider_id')->nullable()->after('service_id');
            $table->string('employee_id')->nullable()->after('provider_id');
            $table->string('customer_id')->nullable()->after('employee_id');
            $table->string('project_id')->nullable()->after('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pqrs', function (Blueprint $table) {
            $table->dropColumn('tema_id');
            $table->dropColumn('service_id');
            $table->dropColumn('provider_id');
            $table->dropColumn('employee_id');
            $table->dropColumn('customer_id');
            $table->dropColumn('project_id');
        });
    }
};
