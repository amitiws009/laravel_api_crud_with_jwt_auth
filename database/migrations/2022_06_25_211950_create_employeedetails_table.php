<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeedetails', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->text('address_1');
            $table->text('address_2');
            $table->string('mobile');
            $table->string('email');
            $table->timestamps();

            // $table->foreign('employee_id')
            //         ->references('id')
            //         ->on('employees')
            //         ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employeedetailes');
    }
}
