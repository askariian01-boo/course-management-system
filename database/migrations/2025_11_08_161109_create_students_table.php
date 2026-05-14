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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('FatherName');
            $table->integer('Gender');
            $table->integer('MaritalStatus');
            $table->date('BirthDay');
            $table->string('Address');
            $table->string('NIC');
            $table->string('Phone');
            $table->string('Image');
            $table->date('RegDate');
            $table->unsignedBigInteger('class_id');
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classes')->cascadeOnDelete()->cascadeOnUpdate();
        });


         Schema::create('student_attendance', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->date('attendance_date');
            $table->enum('status' , ['absent' , 'present']) -> default('present');
            $table->string('remark');

            $table->primary(['student_id' , 'attendance_date']);
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete()->cascadeOnUpdate();
        });


        Schema::create('student_document', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('document_name');
            $table->string('document_file');
            $table->date('uploade_date');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete()->cascadeOnUpdate();
        });


        Schema::create('student_fees', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->integer('fees_year');
            $table->integer('fees_month');
            $table->integer('fees_amount');
            $table->date('payment_date');

            $table->primary(['student_id' , 'fees_year' , 'fees_month']);
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fees');
        Schema::dropIfExists('student_document');
        Schema::dropIfExists('student_attendance');
        Schema::dropIfExists('students');
    }
};
