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
        Schema::create('commercial_order_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('version')->nullable();
            $table->date('validity')->nullable();
            $table->date('date')->nullable();
            $table->string('contract')->nullable();
            $table->string('business_name')->nullable();
            $table->bigInteger('type_document_id')->nullable();
            $table->bigInteger('identification')->nullable();
            $table->string('legal_representative')->nullable();
            $table->string('address')->nullable();
            $table->string('invoice_type')->nullable();
            $table->string('model')->nullable();
            $table->string('email_for_invoicing')->nullable();
            $table->date('invoice_filing_date')->nullable();
            $table->string('schedule')->nullable();
            $table->string('conditions')->nullable();
            $table->string('additional_documentation')->nullable();
            $table->integer('self_retaining')->nullable();
            $table->string('tarifa_icap')->nullable();
            $table->string('regime')->nullable();
            $table->string('major_contributor')->nullable();
//En espera
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
        Schema::dropIfExists('commercial_order_service');
    }
};
