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
        Schema::create('tickets_visits_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('path');
            $table->string('name_original');
            $table->bigInteger('ticket_visit_id');
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
        Schema::dropIfExists('tickets_visits_files');
    }
};
