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
         Schema::create('traducciones', function (Blueprint $table) {
        $table->id();
        $table->string('tabla', 100);
        $table->string('campo', 100);
        $table->unsignedInteger('registro_id');
        $table->enum('idioma', ['es','en'])->default('es');
        $table->text('contenido');
        $table->timestamps();
        $table->unique(['tabla','campo','registro_id','idioma'], 'uq_traduccion');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traducciones');
    }
};
