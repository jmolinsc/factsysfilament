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
        Schema::create('ctes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->string('telefono', 30);
            $table->string('direccion');
            $table->string('dui');
            $table->string('nit');
            $table->string('nrc');
            $table->string('tipo');
            $table->string('email');
            $table->timestamps();

            $table->foreignId('id_ctegrupo')->constrained('ctegrupo')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_ctefamilia')->constrained('ctefamilias')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_pais')->constrained('paises')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_departamento')->constrained('departamentos')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_agente')->constrained('agentes')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_ctecategoria')->constrained('ctecategorias')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctes');
    }
};
