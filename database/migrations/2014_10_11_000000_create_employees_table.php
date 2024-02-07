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

        Schema::create('employees_arl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('employees_eps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('employees_severance_fund', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('employees_pension_fund', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('employees_states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('employees_positions_departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('employees_positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->unsignedBigInteger('department_id');

            // FK
            $table->foreign('department_id')
            ->references('id')
            ->on('employees_positions_departments');

            // Times
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_document_id');
            $table->string('identification', 50);
            $table->string('first_name', 50);
            $table->string('second_name', 50)->default(null)->nullable();
            $table->string('surname', 50);
            $table->string('second_surname', 100)->default(null)->nullable();
            $table->string('full_name');
            $table->date('birth_date')->default(null)->nullable();
            $table->string('email', 100)->default(null)->nullable();
            $table->text('address')->default(null)->nullable();
            $table->string('home_phone')->default(null)->nullable();
            $table->string('cell_phone')->default(null)->nullable();
            $table->enum('gender', ['Feminine','Male','Other'])->default(null)->nullable();
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('arl_id');
            $table->unsignedBigInteger('fund_pension_id');
            $table->unsignedBigInteger('severance_fund_id');
            $table->unsignedBigInteger('eps_id');
            $table->unsignedBigInteger('position_id');
            $table->string('path_document_identification')->default(null)->nullable();
            $table->string('path_document_height_certificate')->default(null)->nullable();

            // FK

            $table->foreign('type_document_id')
                ->references('id')
                ->on('general_types_documents');

            $table->foreign('state_id')
                ->references('id')
                ->on('employees_states');

            $table->foreign('arl_id')
                ->references('id')
                ->on('employees_arl');

            $table->foreign('fund_pension_id')
                ->references('id')
                ->on('employees_pension_fund');

            $table->foreign('severance_fund_id')
                ->references('id')
                ->on('employees_severance_fund');

            $table->foreign('eps_id')
                ->references('id')
                ->on('employees_eps');


            $table->foreign('position_id')
            ->references('id')
            ->on('employees_positions');

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
        Schema::dropIfExists('employees');
        Schema::dropIfExists('employees_positions');
        Schema::dropIfExists('employees_positions_departments');
        Schema::dropIfExists('employees_states');
        Schema::dropIfExists('employees_pension_fund');
        Schema::dropIfExists('employees_severance_fund');
        Schema::dropIfExists('employees_eps');
        Schema::dropIfExists('employees_arl');
        Schema::dropIfExists('employees_types_documents');
    }
};
