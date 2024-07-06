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
        Schema::create('details_order_service_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_service_id');
            $table->bigInteger('type_contact_id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('celphone')->nullable();
            //En espera
            $table->timestamps();
        });

        // Schema::create('general_types_priorities', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('name', 50);
        //     $table->bigInteger('id_ticket_priority');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details_order_service_contacts');
        Schema::dropIfExists('general_types_priorities');
    }
};
