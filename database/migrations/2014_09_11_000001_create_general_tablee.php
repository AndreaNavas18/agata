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
        Schema::create('general_types_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('general_types_contacs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('general_countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('general_departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->unsignedBigInteger('country_id');

            // FK
            $table->foreign('country_id')
                ->references('id')
                ->on('general_countries');

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('general_cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->unsignedBigInteger('department_id');

            // FK
            $table->foreign('department_id')
                ->references('id')
                ->on('general_departments');

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('general_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->default(null)->nullable();

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
        Schema::dropIfExists('general_services');
        Schema::dropIfExists('general_cities');
        Schema::dropIfExists('general_departments');
        Schema::dropIfExists('general_types_contacs');
        Schema::dropIfExists('general_types_contacs');
        Schema::dropIfExists('general_countries');


    }
};
