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

        Schema::create('tickets_priorities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('color', 100);

            // Times
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('ticket_issue', 50);
            $table->unsignedBigInteger('priority_id');
            $table->unsignedBigInteger('employee_position_department_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('customer_service_id');
            $table->enum('state', ['Abierto','Cerrado']);
            $table->text('description');
            $table->string('time_clock', 50)->default(null)->nullable();
            $table->dateTime('datetime_clock')->default(null)->nullable();
            $table->enum('state_clock', ['Corriendo','Detenido']);

            // FK
            $table->foreign('priority_id')
            ->references('id')
            ->on('tickets_priorities');

            $table->foreign('employee_position_department_id')
            ->references('id')
            ->on('employees_positions_departments');

            $table->foreign('customer_id')
            ->references('id')
            ->on('customers');

            $table->foreign('employee_id')
            ->references('id')
            ->on('employees');

            $table->foreign('customer_service_id')
            ->references('id')
            ->on('customers_services')
            ->onDelete('cascade');

            // Times
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('tickets_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->default(null)->nullable();
            $table->unsignedBigInteger('customer_id')->default(null)->nullable();
            $table->unsignedBigInteger('ticket_id')->default(null)->nullable();
            $table->text('replie');

            $table->foreign('employee_id')
            ->references('id')
            ->on('employees');

            $table->foreign('customer_id')
            ->references('id')
            ->on('customers');

            $table->foreign('ticket_id')
            ->references('id')
            ->on('tickets')
            ->onDelete('cascade');

            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tickets_replies_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_replie_id');
            $table->string('name_original');
            $table->string('name_file');
            $table->string('path');
            $table->string('extension');

            $table->foreign('ticket_replie_id')
            ->references('id')
            ->on('tickets_replies')
            ->onDelete('cascade');


            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tickets_visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_replie_id');
            $table->unsignedBigInteger('ticket_id');
            $table->text('description');
            $table->date('date');

            $table->foreign('ticket_replie_id')
            ->references('id')
            ->on('tickets_replies')
            ->onDelete('cascade');


            $table->foreign('ticket_id')
            ->references('id')
            ->on('tickets')
            ->onDelete('cascade');


            // Times
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tickets_visits_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ticket_visit_id');
            $table->unsignedBigInteger('employee_id');

            $table->foreign('ticket_visit_id')
            ->references('id')
            ->on('tickets_visits')
            ->onDelete('cascade');

            $table->foreign('employee_id')
            ->references('id')
            ->on('employees')
            ->onDelete('cascade');

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
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('tickets_priorities');
    }
};
