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
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('office_address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('map')->nullable(); // link google map
            $table->string('watsapp')->nullable(); // link watsapp
            $table->string('telegram')->nullable(); // link telegram
            $table->string('facebook')->nullable(); // link facebook
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};
