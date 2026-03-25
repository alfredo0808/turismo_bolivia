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
       Schema::create('consultas_log', function (Blueprint $table) {
        $table->id();
        $table->foreignId('destino_id')
              ->nullable()
              ->constrained('destinos')
              ->onUpdate('cascade')
              ->onDelete('set null');
        $table->enum('tipo_consulta', [
            'vista_detalle','busqueda','recomendacion',
            'evento','temporada','home'
        ])->default('busqueda');
        $table->string('termino_busqueda', 200)->nullable();
        $table->enum('idioma', ['es','en'])->default('es');
        $table->enum('dispositivo', ['desktop','mobile','tablet'])->nullable();
        $table->string('ip_hash', 64)->nullable();
        $table->date('fecha');
        $table->time('hora');
        $table->timestamp('created_at')->useCurrent();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas_log');
    }
};
