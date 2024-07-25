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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('mov', 50)->nullable();
            $table->string('movid', 50)->nullable();
            $table->string('fechaemision', 50)->nullable();
            $table->string('cliente', 50)->nullable();
            $table->string('sucursal', 50)->nullable();
            $table->string('referencia', 50)->nullable();
            $table->string('concepto', 50)->nullable();
            $table->string('descuentoglobal', 50)->nullable();
            $table->string('condicion', 50)->nullable();
            $table->string('comentarios', 50)->nullable();
            $table->timestamps();

            $table->foreignId('id_alm')->constrained('alms')
                ->onDelete('cascade')->onUpdate('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
