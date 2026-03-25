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
        Schema::create('imagenes_destino', function (Blueprint $table) {
        $table->id();
        $table->foreignId('destino_id')
              ->constrained('destinos')
              ->onUpdate('cascade')
              ->onDelete('cascade');
        $table->string('ruta', 255);
        $table->string('alt_texto', 200)->nullable();
        $table->unsignedTinyInteger('orden')->default(0);
        $table->timestamp('created_at')->useCurrent();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_destino');
    }
};
