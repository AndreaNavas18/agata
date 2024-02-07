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

        Schema::create('customers_states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('customers', function (Blueprint $table) {
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
                ->on('customers_states');

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('customers_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('type_contact_id');
            $table->unsignedBigInteger('city_id');
            $table->string('name', 50);
            $table->string('home_phone')->default(null)->nullable();
            $table->string('cell_phone')->default(null)->nullable();
            $table->string('email')->default(null)->nullable();

            $table->foreign('customer_id')
            ->references('id')
            ->on('customers');

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

        Schema::create('customers_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('city_id');
            $table->date('date_service');
            $table->string('latitude_coordinates')->default(null)->nullable();
            $table->string('longitude_coordinates')->default(null)->nullable();
            $table->enum('installation_type', ['Propia', 'Terceros']);
            $table->unsignedBigInteger('provider_id')->default(null)->nullable();
            $table->text('description')->default(null)->nullable();
            $table->enum('state', ['Activo', 'Inactivo']);

            $table->foreign('customer_id')
            ->references('id')
            ->on('customers');

            $table->foreign('service_id')
            ->references('id')
            ->on('general_services');


            $table->foreign('department_id')
            ->references('id')
            ->on('general_departments');

            $table->foreign('city_id')
            ->references('id')
            ->on('general_cities');

            $table->foreign('provider_id')
            ->references('id')
            ->on('providers');

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
        Schema::dropIfExists('customers_services');
        Schema::dropIfExists('customers_contacts');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customers_states');
    }
};
