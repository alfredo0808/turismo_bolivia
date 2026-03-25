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
       Schema::create('usuarios', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 150);
        $table->string('email', 191)->unique();
        $table->string('password', 255);
        $table->enum('rol', ['superadmin','admin','editor'])->default('editor');
        $table->tinyInteger('activo')->default(1);
        $table->timestamp('ultimo_acceso')->nullable();
        $table->rememberToken();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
