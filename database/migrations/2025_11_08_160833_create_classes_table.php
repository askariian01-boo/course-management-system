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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('ClassName');
            $table->integer('ClassFees');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('capacity')->nullable();
            $table->timestamps();
        });


         Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('SubjectName');
            $table->string('Author')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
        Schema::dropIfExists('subjects');
    }
};
