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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id');
            $table->string('name'); 
            $table->string('email')->unique();
            $table->string('phone')->nullable(); 
            $table->enum('status', ['new', 'contacted', 'converted'])->default('new'); 
            $table->text('message')->nullable();
            $table->text('ai_analysis')->nullable(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
