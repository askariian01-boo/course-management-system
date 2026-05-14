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
        Schema::create('outcome_source', function (Blueprint $table) {
            $table->id();
            $table->string('source_name');
            $table->timestamps();
        });

        Schema::create('outcome', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_id');
            $table->integer('outcome_amount');
            $table->date('outcome_date');
            $table->string('remark')->nullable();
            $table->timestamps();

            $table->foreign('source_id')->references('id')->on('outcome_source')->cascadeOnDelete()->cascadeOnUpdate();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outcome');
        Schema::dropIfExists('outcome_source');
    }
};
