<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\InicioSesiones;
use App\Models\Pagina;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $paginas;
    public $colores;
    public $ingresos = [];
    public $productos;
    public $ventas;
    public $compras;
    public $clientes;

    public function mount()
    {
        Pagina::UpdateVisita('dashboard');
        $this->paginas = Pagina::GetMoreVisited();
        $this->ingresos = InicioSesiones::GetLastSesiones();
        $this->productos = count(Producto::all());
        $this->ventas = Pedido::GetValueVentas();
        $this->compras = Compra::GetValueCompras();
        $this->clientes = User::GetClientes();
        $this->colores = [
            '#FFCE56',
            '#FF6384',
            '#36A2EB',
            '#FFCD56',
        ];
    }

    public function render()
    {
        $visitas = Pagina::GetPagina('dashboard') ?? 0;
        return view('livewire.dashboard', compact('visitas'))->layout(auth()->user()->tema);
    }
}
