<?php

namespace App\Http\Livewire\Public\Pedido;

use App\Models\Carrito;
use App\Models\CarritoDetalle;
use App\Models\Pagina;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Producto;
use Livewire\Component;

class ConfirmPedido extends Component
{
    public $carrito;
    public $detalles;
    public $detalleRespaldo;
    public $pedido;
    public $total;
    public $cantidades;
    public $cantProducts;
    public $mostrarQR = false;
    public $error = false;

    public function mount()
    {
        if ($this->mostrarQR) return;
        $this->carrito = Carrito::GetCarrito();
        $this->detalles = CarritoDetalle::GetCarritoDetalles();
        $this->total = $this->carrito->monto_total;
        $this->cantProducts = count($this->detalles);
        foreach ($this->detalles as $detalle) {
            $this->cantidades[$detalle->id] = $detalle->cantidad;
        }
        Pagina::UpdateVisita('public.confirm_pedido');
    }

    public function addCart($id, $cantidad)
    {
        if ($this->mostrarQR) return;
        $producto = Producto::GetProducto($id);
        $detalle = CarritoDetalle::CreateCarritoDetalle([
            'cantidad' => $cantidad,
            'producto_id' => $id,
            'carrito_id' => $this->carrito->id,
            'precio' => $producto->precio,
        ]);
        $this->carrito = Carrito::UpdateMontoTotal(
            $this->carrito->monto_total + ($detalle->cantidad * $producto->precio)
        );
        dd($this->carrito->monto_total);
        $this->refresh();
        $this->emit('refresh');
    }

    public function removeCart($id)
    {
        if ($this->mostrarQR) return;
        $detalle = CarritoDetalle::DeleteCarritoDetalle($id);
        $this->carrito = Carrito::UpdateMontoTotal($this->carrito->monto_total - ($detalle->cantidad * $detalle->precio));
        $this->refresh();
        $this->emit('refresh');
    }

    public function updateCart($id, $value)
    {
        if ($this->mostrarQR) return;
        $this->cantidades[$id] = $this->cantidades[$id] + $value;
        $detalle = CarritoDetalle::UpdateCarritoDetalle($id, [
            'cantidad' => $this->cantidades[$id],
        ]);
        $this->carrito = Carrito::UpdateMontoTotal(
            $this->carrito->monto_total + ($value * $detalle->precio)
        );
        $this->refresh();
        $this->emit('refresh');
    }

    public function refresh()
    {
        if ($this->mostrarQR) return;
        $this->reset('detalles', 'total');
        $this->detalles = CarritoDetalle::GetCarritoDetalles();
        $this->total = $this->carrito->monto_total;
    }

    public function confirmPedido()
    {
        $stockValid = CarritoDetalle::ValidStock();
        if ($stockValid) {
            $this->detalleRespaldo = $this->detalles;
            $this->pedido = Pedido::CreatePedido();
            redirect()->route('public.pedido.qr', $this->pedido->id);
        } else {
            $this->error = true;
        }
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('public.confirm_pedido') ?? 0;
        return view('livewire.public.pedido.confirm-pedido', compact('visitas'))->layout('layouts.public', ['fondo' => false]);
    }
}
