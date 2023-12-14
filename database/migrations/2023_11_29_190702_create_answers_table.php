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
        Schema::create('answer', function (Blueprint $table) {
            $table->id();
            // Declaramos el campo que hará referencia a clave foránea
            $table->foreignId("idquestion");
            $table->string('name', 200);
            $table->boolean('escorrecta');
            $table->timestamps();
            
            // Definimos la clave foránea
            $table->foreign('idquestion')->references('id')->on('question')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer');
    }
};
