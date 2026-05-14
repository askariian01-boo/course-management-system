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
        // Schema::create('teachers', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('user_id')->nullable();
        //     $table->string('FirstName');
        //     $table->string('LastName');
        //     $table->string('FatherName');
        //     $table->string('Gender');
        //     $table->string('MaritalStatus');
        //     $table->date('BirthDay');
        //     $table->string('Address');
        //     $table->string('Image');
        //     $table->string('NIC')->unique();
        //     $table->string('Phone')->unique();
        //     $table->string('Email')->unique();
        //     $table->string('EducationDegree');
        //     $table->string('EducationUniversity');
        //     $table->integer('EducationYear');
        //     $table->integer('TalnetScore');
        //     $table->integer('GrossSalary');
        //     $table->Date('RegDate');

        //     $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->timestamps();
        // });


        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            // مهم ترین بخش 👇
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('FatherName');
            $table->string('Gender');
            $table->string('Email')->unique();
            $table->string('MaritalStatus');
            $table->date('BirthDay');
            $table->string('Address');
            $table->string('Image');
            $table->string('NIC')->unique();
            $table->string('Phone')->unique();
            $table->string('EducationDegree');
            $table->string('EducationUniversity');
            $table->integer('EducationYear');
            $table->integer('TalnetScore');
            $table->integer('GrossSalary');
            $table->date('RegDate');
            $table->timestamps();
        });

        Schema::create('teacher_salary', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id');
            $table->integer('salary_year');
            $table->integer('salary_month');
            $table->integer('absent_days')->default(0);
            $table->integer('absent_amount')->default(0);
            $table->integer('payable_salary');
            $table->integer('net_salary');
            $table->string('status')->default('unpaid');
            $table->Date('pay_date');

            $table->primary(['teacher_id', 'salary_year', 'salary_month']);

            $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnDelete()->cascadeOnUpdate();
        });


        Schema::create('teacher_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->string('document_name');
            $table->string('document_file');
            $table->Date('uploade_date');

            $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnDelete()->cascadeOnUpdate();
        });


        Schema::create('teacher_attendance', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id');
            $table->date('attendance_date');
            $table->enum('status', ['absent', 'present'])->default('present');
            $table->string('remark');

            $table->primary(['teacher_id', 'attendance_date']);

            $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_attendance');
        Schema::dropIfExists('teacher_document');
        Schema::dropIfExists('teacher_salary');
        Schema::dropIfExists('teachers');
    }
};
