<?php

namespace App\Http\Livewire\Pedido\Pedidos;

use App\Models\Pagina;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Livewire\Component;
use Livewire\WithPagination;

class ListPedido extends Component
{
    use WithPagination;
    public $search = '';
    public $notificacion = false;
    public $type = 'success';
    public $message = 'Creado correctamente';
    public $layout;

    public function mount()
    {
        Pagina::UpdateVisita('pedido.list');
        $this->layout = auth()->user()->tema;
    }

    public function toggleNotificacion()
    {
        $this->notificacion = !$this->notificacion;
        $this->emit('notificacion');
    }

    //Metodo de reinicio de buscador
    public function updatingAttribute()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $pedido = Pedido::find($id);

        if ($pedido) {
            // Eliminar los detalles del pedido antes de eliminar el pedido
            PedidoDetalle::where('pedido_id', $pedido->id)->delete();

            // Eliminar el pedido
            $pedido->delete();

            $this->message = 'Eliminado correctamente';
            $this->type = 'success';
        } else {
            $this->message = 'Error al eliminar';
            $this->type = 'error';
        }

        $this->notificacion = true;
    }

    public function render()
    {
        $pedidos = Pedido::GetPedidos($this->search, 'ASC', 20);
        $visitas = Pagina::GetPagina('pedido.list') ?? 0;
        return view('livewire.pedido.pedidos.list-pedido', compact('pedidos', 'visitas'))->layout($this->layout);
    }
}
