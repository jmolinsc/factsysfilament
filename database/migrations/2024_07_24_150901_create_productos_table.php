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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->nullable();
            $table->string('producto')->nullable();
            $table->decimal('precio_compra', 10, 2)->nullable();
            $table->decimal('precio_venta', 10, 2)->nullable();
            $table->string('foto', 100)->nullable()->nullable();
            $table->timestamps();

            $table->foreignId('id_categoria')->constrained('categorias')
                ->onDelete('cascade')->onUpdate('cascade')->nullable();


            $table->foreignId('id_fabricante')->constrained('fabricantes')
                ->onDelete('cascade')->onUpdate('cascade')->nullable();

            $table->foreignId('id_familia')->constrained('familias')
                ->onDelete('cascade')->onUpdate('cascade')->nullable();

            $table->foreignId('id_linea')->constrained('lineas')
                ->onDelete('cascade')->onUpdate('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
