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
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idquestion');
            $table->foreignId('idanswer');
            $table->string('alias', 100);
            $table->boolean('escorrecta');
            $table->timestamps();
            
            // Definimos las claves foráneas
            $table->foreign('idquestion')->references('id')->on('question')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idanswer')->references('id')->on('answer')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
