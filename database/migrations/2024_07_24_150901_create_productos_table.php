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
            $table->string('producto', 50)->nullable();
            $table->string('descripcion')->nullable();
            $table->string('unidad')->nullable();
            $table->string('peso')->nullable();
            $table->string('estatus')->nullable();
            $table->string('tipo')->nullable();
            $table->boolean('secompra')->nullable();
            $table->boolean('sevende')->nullable();
            $table->boolean('seproduce')->nullable();
            $table->decimal('precio_compra', 10, 2)->nullable();
            $table->decimal('preciolista', 10, 2)->nullable();
            $table->decimal('precio2', 10, 2)->nullable();
            $table->decimal('precio3', 10, 2)->nullable();
            $table->decimal('precio_venta', 10, 2)->nullable();
            $table->string('foto', 100)->nullable();
            $table->string('cuenta2')->nullable();
            $table->string('cuenta3')->nullable();
            $table->string('proveedor')->nullable();
            $table->string('iva')->nullable();
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
