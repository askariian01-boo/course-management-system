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
        Schema::create('timetable', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('weekday');
            $table->unsignedTinyInteger('period');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('start_time');
            $table->string('end_time');

            // جلوگیری از تداخل استاد و صنف
            $table->unique(['weekday', 'start_time', 'end_time', 'class_id']);
            $table->unique(['weekday', 'start_time', 'end_time', 'teacher_id']);

            // foreign keys
            $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('class_id')->references('id')->on('classes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('subject_id')->references('id')->on('subjects')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetable');
    }
};
