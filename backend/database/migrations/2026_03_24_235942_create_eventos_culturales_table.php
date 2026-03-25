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
        Schema::create('eventos_culturales', function (Blueprint $table) {
        $table->id();
        $table->foreignId('destino_id')
              ->constrained('destinos')
              ->onUpdate('cascade')
              ->onDelete('cascade');
        $table->string('nombre', 200);
        $table->text('descripcion')->nullable();
        $table->enum('tipo', [
            'festival','feria','carnaval','feriado',
            'ceremonia','gastronomico','deportivo','otro'
        ])->default('festival');
        $table->unsignedTinyInteger('mes');
        $table->unsignedTinyInteger('dia_inicio')->nullable();
        $table->unsignedTinyInteger('dia_fin')->nullable();
        $table->tinyInteger('es_anual')->default(1);
        $table->tinyInteger('activo')->default(1);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_culturales');
    }
};
