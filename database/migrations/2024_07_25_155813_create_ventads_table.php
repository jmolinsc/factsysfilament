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
        Schema::create('ventads', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->nullable();
            $table->string('producto', 50)->nullable();
            $table->string('cantidad', 50)->nullable();
            $table->string('precio', 50)->nullable();
            $table->string('unidad', 50)->nullable();
            $table->string('descuentolinea', 50)->nullable();
            $table->string('importe', 50)->nullable();
            $table->string('ivaimp', 50)->nullable();
            $table->string('iva', 50)->nullable();
            $table->timestamps();

            $table->foreignId('idventa')->constrained('venta')
            ->onDelete('cascade')->onUpdate('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventads');
    }
};
