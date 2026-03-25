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
        Schema::create('destinos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('categoria_id')
              ->constrained('categorias')
              ->onUpdate('cascade')
              ->onDelete('restrict');
        $table->string('nombre', 150);
        $table->text('descripcion');
        $table->enum('departamento', [
            'La Paz','Cochabamba','Santa Cruz','Oruro',
            'Potosi','Chuquisaca','Tarija','Beni','Pando'
        ]);
        $table->string('ubicacion', 200)->nullable();
        $table->decimal('latitud', 10, 8)->nullable();
        $table->decimal('longitud', 11, 8)->nullable();
        $table->unsignedInteger('altitud_msnm')->nullable();
        $table->string('imagen_portada', 255)->nullable();
        $table->tinyInteger('activo')->default(1);
        $table->tinyInteger('destacado')->default(0);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinos');
    }
};
