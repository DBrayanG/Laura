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
        // Schema::create('rol', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->string('nombre');
        //     $table->text('descripcion');
        //     $table->timestamps();
        // });
        // Schema::create('usuario', function (Blueprint $table) {
        //     $table->id()->autoIncrement();
        //     $table->string('nombre');
        //     $table->string('correo')->unique();
        //     $table->string('contraseña');
        //     $table->string('direccion')->nullable();
        //     $table->string('telefono')->nullable();
        //     $table->string('cargo')->nullable();
        //     $table->boolean('es_cliente')->nullable();
        //     $table->boolean('es_personal')->nullable();
        //     $table->boolean('es_administrador')->nullable();
        //     $table->timestamps();
        // });
        Schema::create('inicio_sesiones', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('fecha');
            $table->string('hora');
            $table->string('ip');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('pagina', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombre');
            $table->string('ruta');
            $table->unsignedBigInteger('visitas')->default(0);
            $table->timestamps();
        });

        Schema::create('producto', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombre');
            $table->string('imagen');
            $table->string('tamaño');
            $table->float('precio');
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->string('categoria');
            $table->timestamps();
        });

        Schema::create('proveedor', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombre');
            $table->string('correo');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('nit');
            $table->timestamps();
        });

        Schema::create('ingreso', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('fecha');
            $table->string('hora');
            $table->string('motivo');
            $table->timestamps();
        });

        Schema::create('ingreso_detalle', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('cantidad');
            $table->unsignedBigInteger('ingreso_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('ingreso_id')->references('id')->on('ingreso')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('producto')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('salida', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('fecha');
            $table->string('hora');
            $table->string('motivo');
            $table->timestamps();
        });

        Schema::create('salida_detalle', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('cantidad');
            $table->unsignedBigInteger('salida_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('salida_id')->references('id')->on('salida')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('producto')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('compra', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('fecha');
            $table->string('hora');
            $table->float('monto_total');
            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedor')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('compra_detalle', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('cantidad');
            $table->float('precio');
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('compra_id')->references('id')->on('compra')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('producto')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('pedido', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('fecha');
            $table->string('hora');
            $table->float('monto_total');
            $table->string('estado');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('pedido_detalle', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('cantidad');
            $table->float('precio');
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('pedido_id')->references('id')->on('pedido')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('producto')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('carrito', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->float('monto_total');
            $table->string('fecha');
            $table->string('hora');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('carrito_detalle', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('cantidad');
            $table->float('precio');
            $table->unsignedBigInteger('carrito_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('carrito_id')->references('id')->on('carrito')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('producto')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_detalle');
        Schema::dropIfExists('carrito');
        Schema::dropIfExists('pedido_detalle');
        Schema::dropIfExists('pedido');
        Schema::dropIfExists('compra_detalle');
        Schema::dropIfExists('compra');
        Schema::dropIfExists('salida_detalle');
        Schema::dropIfExists('salida');
        Schema::dropIfExists('ingreso_detalle');
        Schema::dropIfExists('ingreso');
        Schema::dropIfExists('proveedor');
        Schema::dropIfExists('producto');
        Schema::dropIfExists('inicio_sesiones');
        Schema::dropIfExists('pagina');
        Schema::dropIfExists('usuario');
        // Schema::dropIfExists('rol');
    }
};
