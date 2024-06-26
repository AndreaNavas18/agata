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
        Schema::create('details_quotes_section', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quote_id');
            $table->string('tramo')->nullable();
            $table->bigInteger('hilos')->nullable();
            $table->text('extremo_a')->nullable();
            $table->text('extremo_b')->nullable();
            $table->bigInteger('kms')->nullable();
            $table->bigInteger('recurrente_mes')->nullable();
            $table->bigInteger('recurrente_12')->nullable();
            $table->bigInteger('recurrente_24')->nullable();
            $table->bigInteger('recurrente_36')->nullable();
            $table->string('tiempo')->nullable();
            $table->bigInteger('valor_km_usd')->nullable();
            $table->bigInteger('valor_total_iru_usd')->nullable();
            $table->bigInteger('valor_km_cop')->nullable();
            $table->bigInteger('valor_total')->nullable();
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
        Schema::dropIfExists('details_quotes_section');
    }
};
