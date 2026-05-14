<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('staff', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('user_id')->nullable();
        //     $table->string('FirstName');
        //     $table->string('LastName');
        //     $table->string('FatherName');
        //     $table->integer('Gender');
        //     $table->string('Image');
        //     $table->string('NIC')->unique();
        //     $table->string('phone')->unique();
        //     $table->string('Email')->unique();
        //     $table->string('Position');
        //     $table->string('Address');
        //     $table->integer('GrossSalary');
        //     $table->date('RegDate');

        //     $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->timestamps();
        // });



        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('FatherName');
            $table->enum('Gender', ['male', 'female']);
            $table->string('Image');
            $table->string('NIC')->unique();
            $table->string('phone')->unique();
            $table->string('Email')->unique();
            $table->string('Position');
            $table->string('Address');
            $table->integer('GrossSalary');
            $table->date('RegDate');
            $table->timestamps();
        });


        Schema::create('staff_salary', function (Blueprint $table) {
            $table->unsignedBigInteger('staff_id');
            $table->integer('salary_year');
            $table->integer('salary_month');
            $table->integer('absent_days')->default(0);
            $table->integer('absent_amount')->default(0);
            $table->string('status')->default('unpaid');
            $table->integer('payable_salary');
            $table->integer('net_salary');
            $table->date('pay_date');
            $table->primary(['staff_id', 'salary_year', 'salary_month']);

            $table->foreign('staff_id')->references('id')->on('staff')->cascadeOnDelete()->cascadeOnUpdate();
        });


        Schema::create('staff_attendance', function (Blueprint $table) {
            $table->unsignedBigInteger('staff_id');
            $table->date('attendance_date');
            $table->enum('status', ['absent', 'present'])->default('present');
            $table->string('remark');

            $table->primary(['staff_id', 'attendance_date']);

 
            $table->foreign('staff_id')->references('id')->on('staff')->cascadeOnDelete()->cascadeOnUpdate();
        });



        Schema::create('staff_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->string('document_name');
            $table->string('document_file');
            $table->date('uplode_date');

            $table->foreign('staff_id')->references('id')->on('staff')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_document');
        Schema::dropIfExists('staff_attendance');
        Schema::dropIfExists('staff_salary');
        Schema::dropIfExists('staff');
    }
};
