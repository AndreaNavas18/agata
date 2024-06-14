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
        Schema::create('commercial_tariffs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('commercial_type_service_id')->nullable();
            $table->unsignedBigInteger('bandwidth_id')->nullable();
            $table->unsignedBigInteger('recurring_value_12')->nullable();
            $table->integer('months')->nullable();
            $table->unsignedBigInteger('value_mbps_12')->nullable();


            $table->foreign('bandwidth_id')
            ->references('id')
            ->on('commercial_bandwidths');

            $table->foreign('commercial_type_service_id')
            ->references('id')
            ->on('commercial_type_services');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commercial_tariffs');
    }
};
