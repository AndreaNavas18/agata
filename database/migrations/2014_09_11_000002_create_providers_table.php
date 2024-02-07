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

        Schema::create('providers_states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_document_id');
            $table->string('identification', 50);
            $table->string('name', 50);
            $table->text('address');
            $table->string('phone')->default(null)->nullable();
            $table->unsignedBigInteger('city_id');
            $table->string('neighborhood')->default(null)->nullable();
            $table->text('observations')->default(null)->nullable();
            $table->unsignedBigInteger('state_id');

            // FK
            $table->foreign('type_document_id')
            ->references('id')
            ->on('general_types_documents');

            $table->foreign('city_id')
            ->references('id')
            ->on('general_cities');


            $table->foreign('state_id')
                ->references('id')
                ->on('providers_states');

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('providers_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('type_contact_id');
            $table->unsignedBigInteger('city_id');
            $table->string('name', 50);
            $table->string('home_phone')->default(null)->nullable();
            $table->string('cell_phone')->default(null)->nullable();
            $table->string('email')->default(null)->nullable();

            $table->foreign('provider_id')
            ->references('id')
            ->on('providers');

            $table->foreign('type_contact_id')
            ->references('id')
            ->on('general_types_contacs');

            $table->foreign('city_id')
            ->references('id')
            ->on('general_cities');

            // Times
            $table->timestamps();
            $table->softDeletes();
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers_contacts');
        Schema::dropIfExists('providers');
        Schema::dropIfExists('providers_states');
    }
};
