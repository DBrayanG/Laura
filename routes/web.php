<?php

use App\Http\Controllers\PagoFacilController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegisterController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Compra\ListCompra;
use App\Http\Livewire\Compra\ShowCompra;
use App\Http\Livewire\Compra\NewCompra;
use App\Http\Livewire\CompraDetalle\NewCompraDetalle;
use App\Http\Livewire\Ingreso\ListIngreso;
use App\Http\Livewire\Ingreso\ShowIngreso;
use App\Http\Livewire\Ingreso\NewIngreso;
use App\Http\Livewire\IngresoDetalle\NewIngresoDetalle;
use App\Http\Livewire\Salida\ListSalida;
use App\Http\Livewire\Salida\ShowSalida;
use App\Http\Livewire\Salida\NewSalida;
use App\Http\Livewire\SalidaDetalle\NewSalidaDetalle;
use App\Http\Livewire\Producto\ListProducto;
use App\Http\Livewire\Producto\NewProducto;
use App\Http\Livewire\Producto\EditProducto;
use App\Http\Livewire\Pedido\Pedidos\ListPedido;
use App\Http\Livewire\Pedido\Pedidos\NewPedido;
use App\Http\Livewire\Pedido\Pedidos\ShowPedido;
use App\Http\Livewire\Producto\ShowProducto;
use App\Http\Livewire\Proveedor\EditProveedor;
use App\Http\Livewire\Proveedor\ListProveedor;
use App\Http\Livewire\Proveedor\NewProveedor;
use App\Http\Livewire\Proveedor\ShowProveedor;
use App\Http\Livewire\Public\AcercaDe;
use App\Http\Livewire\Public\Auth\Profile;
use App\Http\Livewire\Public\Contacto;
use App\Http\Livewire\Public\Inicio;
use App\Http\Livewire\Public\Pedido\ConfirmPedido;
use App\Http\Livewire\Public\Pedido\ListPedido as PedidoListPedido;
use App\Http\Livewire\Public\Pedido\PagarQR;
use App\Http\Livewire\Public\Pedido\ShowCarrito;
use App\Http\Livewire\Public\Pedido\ShowPedido as PedidoShowPedido;
use App\Http\Livewire\Public\Producto\ListProduct;
use App\Http\Livewire\Public\Producto\ShowProduct;
use App\Http\Livewire\Sistema\Rol\EditRol;
use App\Http\Livewire\Sistema\Rol\ListRol;
use App\Http\Livewire\Sistema\Rol\NewRol;
use App\Http\Livewire\Sistema\Usuario\EditUsuario;
use App\Http\Livewire\Sistema\Usuario\ListUsuario;
use App\Http\Livewire\Sistema\Usuario\NewUsuario;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Inicio::class);
Route::get('/inicio', Inicio::class)->name('inicio');
Route::get('/inicio/registrar', [RegisterController::class, 'register'])->name('inicio.register');
Route::post('/inicio/registrar/store', [RegisterController::class, 'store'])->name('inicio.register.store');
Route::get('/inicio/producto', ListProduct::class)->name('public.producto.list');
Route::get('/inicio/producto/{id}', ShowProduct::class)->name('public.producto.show');
Route::get('/inicio/carrito', ShowCarrito::class)->name('public.carrito');
Route::get('/inicio/pedido/confirm', ConfirmPedido::class)->name('public.confirm_pedido');
Route::get('/inicio/acerca-de', AcercaDe::class)->name('public.acerca_de');
Route::get('/inicio/contacto', Contacto::class)->name('public.contacto');
Route::get('/inicio/perfil', Profile::class)->name('public.perfil');
Route::get('/inicio/pedidos', PedidoListPedido::class)->name('public.pedido');
Route::get('/inicio/pedidos/{id}', PedidoShowPedido::class)->name('public.pedido.show');
Route::get('/inicio/qr/{id}', PagarQR::class)->name('public.pedido.qr');

Route::group(['prefix' => 'pago_facil'], function () {
    Route::get('/qr/{pedido}', [PagoFacilController::class, 'GenerarQR'])->name('pago_facil.pagar.qr');
    Route::get('/pagar/{usuario}/{pedido}/{nit}', [PagoFacilController::class, 'RecolectarDatos'])->name('pago_facil.pagar');
    Route::post('/estado/{pedido}', [PagoFacilController::class, 'ConsultarEstado'])->name('pago_facil.estado');
    Route::get('/callback/{pedido}', [PagoFacilController::class, 'urlCallback'])->name('pago_facil.callback');
});
Route::group(['prefix' => 'reporte', 'middleware' => ['auth']], function () {
    Route::get('/generar-pdf/productos', [PDFController::class, 'generarPDF'])->name('reporte.productos');
    Route::get('/generar-pdf/ventas', [PDFController::class, 'generarPDF2'])->name('reporte.ventas');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    // MODULO SISTEMA
    Route::group(['prefix' => 'usuario', 'middleware' => ['can:usuarios', 'auth']], function () {
        Route::get('/list', ListUsuario::class)->name('usuario.list');
        Route::get('/new', NewUsuario::class)->name('usuario.new');
        Route::get('/edit/{usuario}', EditUsuario::class)->name('usuario.edit');
    });

    Route::group(['prefix' => 'rol', 'middleware' => ['can:roles', 'auth']], function () {
        Route::get('/list', ListRol::class)->name('rol.list');
        Route::get('/new', NewRol::class)->name('rol.new');
        Route::get('/edit/{rol}', EditRol::class)->name('rol.edit');
    });

    // MODULO PEDIDO
    Route::group(['prefix' => 'pedido', 'middleware' => ['can:pedidos', 'auth']], function () {
        Route::get('/list', ListPedido::class)->name('pedido.list');
        Route::get('/new', NewPedido::class)->name('pedido.new');
        Route::get('/show/{pedido}', ShowPedido::class)->name('pedido.show');
    });

    // MODULO PRODUCTO
    Route::group(['prefix' => 'producto', 'middleware' => ['can:productos', 'auth']], function () {
        Route::get('/list', ListProducto::class)->name('producto.list');
        Route::get('/new', NewProducto::class)->name('producto.new');
        Route::get('/edit/{producto}', EditProducto::class)->name('producto.edit');
        Route::get('/show/{producto}', ShowProducto::class)->name('producto.show');
    });

    Route::group(['prefix' => 'proveedor', 'middleware' => ['can:proveedores', 'auth']], function () {
        Route::get('/list', ListProveedor::class)->name('proveedor.list');
        Route::get('/new', NewProveedor::class)->name('proveedor.new');
        Route::get('/edit/{proveedor}', EditProveedor::class)->name('proveedor.edit');
        Route::get('/show/{proveedor}', ShowProveedor::class)->name('proveedor.show');
    });


    // MODULO COMPRA
    Route::group(['prefix' => 'compra', 'middleware' => ['can:compras', 'auth']], function () {
        Route::get('/list', ListCompra::class)->name('compra.list');
        Route::get('/new', NewCompra::class)->name('compra.new');
        Route::get('/show/{id}', ShowCompra::class)->name('compra.show');
        Route::get('/detalle/{id}', NewCompraDetalle::class)->name('compra-detalle.new');
    });

    // MODULO INVENTARIO - INGRESO
    Route::group(['prefix' => 'ingreso', 'middleware' => ['can:ingresos', 'auth']], function () {
        Route::get('/list', ListIngreso::class)->name('ingreso.list');
        Route::get('/new', NewIngreso::class)->name('ingreso.new');
        Route::get('/show/{id}', ShowIngreso::class)->name('ingreso.show');
        Route::get('/detalle/{id}', NewIngresoDetalle::class)->name('ingreso-detalle.new');
    });

    // MODULO INVENTARIO - SALIDA
    Route::group(['prefix' => 'salida', 'middleware' => ['can:salidas', 'auth']], function () {
        Route::get('/list', ListSalida::class)->name('salida.list');
        Route::get('/new', NewSalida::class)->name('salida.new');
        Route::get('/show/{id}', ShowSalida::class)->name('salida.show');
        Route::get('/detalle/{id}', NewSalidaDetalle::class)->name('salida-detalle.new');
    });
});
