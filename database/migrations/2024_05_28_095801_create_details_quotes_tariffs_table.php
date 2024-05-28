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
        Schema::create('details_quotes_tariffs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quote_id');
            $table->string('name_service')->nullable();
            $table->string('bandwidth')->nullable();
            $table->bigInteger('nrc_12')->nullable();
            $table->bigInteger('nrc_24')->nullable();
            $table->bigInteger('nrc_36')->nullable();
            $table->bigInteger('mrc_12')->nullable();
            $table->bigInteger('mrc_24')->nullable();
            $table->bigInteger('mrc_36')->nullable();
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
        Schema::dropIfExists('details_quotes_tariffs');
    }
};
