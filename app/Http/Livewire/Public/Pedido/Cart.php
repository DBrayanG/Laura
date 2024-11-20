<?php

namespace App\Http\Livewire\Public\Pedido;

use App\Models\Carrito;
use App\Models\CarritoDetalle;
use App\Models\Producto;
use Livewire\Component;

class Cart extends Component
{
    public $carrito;
    public $detalles = [];
    public $cantProducts;

    public $listeners = ['addCart', 'removeCart', 'updateCart', 'refresh'];


    public function mount()
    {
        if (!auth()->user()) {
            $this->cantProducts = 0;
            return;
        }
        $this->carrito = Carrito::GetCarrito();
        $this->refresh();
    }

    public function addCart($id, $cant)
    {
        $producto = Producto::GetProducto($id);
        $detalle = CarritoDetalle::CreateCarritoDetalle([
            'cantidad' => $cant,
            'producto_id' => $id,
            'carrito_id' => $this->carrito->id,
            'precio' => $producto->precio,
        ]);
        $this->carrito = Carrito::UpdateMontoTotal($this->carrito->monto_total + ($detalle->cantidad * $producto->precio));
        $this->refresh();
    }

    public function refresh()
    {
        $this->reset('detalles', 'cantProducts');
        $this->detalles = CarritoDetalle::GetCarritoDetalles();
        $this->cantProducts = count($this->detalles);
    }

    public function refresh2()
    {
        dd('refresh2');
        $this->reset('detalles', 'cantProducts');
        $this->cantProducts = CarritoDetalle::GetCantProducts();
        $this->detalles = CarritoDetalle::GetCarritoDetalles();
    }

    public function removeCart($id)
    {
        $detalle = CarritoDetalle::DeleteCarritoDetalle($id);
        $this->carrito = Carrito::UpdateMontoTotal($this->carrito->monto_total - ($detalle->cantidad * $detalle->producto->precio));
        $this->refresh();
    }

    public function updateCart($id, $cant)
    {
        $detalle = CarritoDetalle::UpdateCarritoDetalle($id, [
            'cantidad' => $cant,
        ]);
        $this->carrito = Carrito::UpdateMontoTotal($this->carrito->monto_total - ($detalle->cantidad * $detalle->producto->precio));
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.public.pedido.cart');
    }
}
