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
        Schema::create('temporadas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('destino_id')
              ->constrained('destinos')
              ->onUpdate('cascade')
              ->onDelete('cascade');
        $table->unsignedTinyInteger('mes_inicio');
        $table->unsignedTinyInteger('mes_fin');
        $table->enum('nivel', ['alta','media','baja'])->default('media');
        $table->text('descripcion')->nullable();
        $table->string('clima', 200)->nullable();
        $table->decimal('temperatura_min', 4, 1)->nullable();
        $table->decimal('temperatura_max', 4, 1)->nullable();
        $table->enum('precipitacion', ['baja','moderada','alta'])->nullable();
        $table->enum('nivel_afluencia', ['bajo','moderado','alto'])->nullable();
        $table->tinyInteger('activo')->default(1);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporadas');
    }
};
