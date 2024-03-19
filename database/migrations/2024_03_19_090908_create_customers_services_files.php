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
        Schema::create('customers_services_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('path');
            $table->string('name_original');
            $table->bigInteger('customers_services_id');
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
        Schema::dropIfExists('customers_services_files');
    }
};
