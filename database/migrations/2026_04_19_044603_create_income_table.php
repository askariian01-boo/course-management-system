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
        Schema::create('income_source', function (Blueprint $table) {
            $table->id();
            $table->string('source_name');
            $table->timestamps();
        });

        Schema::create('income', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id');
            $table->integer('income_amount');
            $table->date('income_date');
            $table->timestamps();


            $table->foreign('source_id')->references('id')->on('income_source')->cascadeOnDelete()->cascadeOnUpdate();
        });


    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income');
        Schema::dropIfExists('income_source');
    }
};
