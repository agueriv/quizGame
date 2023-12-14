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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->unique();
            $table->string('password', 50);
            // Creamos el campo para guardar la portada del disco
            $table->binary('photo')->nullable();
            $table->timestamps();
        });
        
        // Vamos a cambiar el tipo del campo cover para subir fotos mas grandes
        $sql = 'alter table admin change photo photo longblob';
        //las migraciones de Laravel no ofrecen el tipo longblob
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
