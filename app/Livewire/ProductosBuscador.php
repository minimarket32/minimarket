<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Log;

class ProductosBuscador extends Component
{
    public $search = '';
    public $categoria = '';

    // Campos del formulario
    public $producto_id, $codigo_barras, $nombre, $precio_compra, $precio_venta, $stock, $categoria_id, $imagen;
    public $modo_editar = false;

    protected $rules = [
        'codigo_barras' => 'nullable|string|max:50', 
        'nombre' => 'required|string|max:255',
        'precio_compra' => 'required|numeric|min:0',
        'precio_venta' => 'required|numeric|min:0',
        'stock' => 'required|numeric|min:0',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|string' 
    ];

    public function updatedCodigoBarras()
    {
        if (strlen($this->codigo_barras) < 3 || $this->modo_editar) return;

        $producto = Producto::where('codigo_barras', $this->codigo_barras)->first();

        if ($producto) {
            $this->populateFields($producto);
            $this->modo_editar = true;
        }
    }

    public function updatedPrecioCompra()
    {
        if (is_numeric($this->precio_compra) && $this->precio_compra > 0) {
            $this->precio_venta = round($this->precio_compra * 1.20);
        }
    }

    public function guardar()
    {
        $this->validate();

        try {
            Producto::updateOrCreate(
                ['id' => $this->producto_id],
                [
                    'codigo_barras' => $this->codigo_barras,
                    'nombre'        => $this->nombre,
                    'precio_compra' => $this->precio_compra,
                    'precio_venta'  => $this->precio_venta,
                    'stock'         => $this->stock,
                    'categoria_id'  => $this->categoria_id,
                    'imagen'        => $this->imagen,
                ]
            );

            session()->flash('success', $this->modo_editar ? '¡Producto actualizado!' : '¡Producto creado!');
            
            // Cerramos el modal primero para que la interfaz sepa que terminó la acción
            $this->dispatch('cerrarModalProducto');
            $this->resetCampos();

        } catch (\Exception $e) {
            Log::error("Error al guardar producto: " . $e->getMessage());
            session()->flash('error', 'Error al guardar en la base de datos.');
        }
    }

    public function editar($id)
    {
        $producto = Producto::find($id);
        if($producto) {
            $this->populateFields($producto);
            $this->modo_editar = true;
            $this->dispatch('abrirModalProducto');
        }
    }

    private function populateFields($producto) {
        $this->producto_id = $producto->id;
        $this->codigo_barras = $producto->codigo_barras;
        $this->nombre = $producto->nombre;
        $this->precio_compra = $producto->precio_compra;
        $this->precio_venta = $producto->precio_venta;
        $this->stock = $producto->stock;
        $this->categoria_id = $producto->categoria_id;
        $this->imagen = $producto->imagen;
    }

    public function eliminar($id)
    {
        Producto::find($id)?->delete();
        session()->flash('success', 'Producto eliminado.');
    }

    public function resetCampos()
    {
        $this->reset(['producto_id', 'codigo_barras', 'nombre', 'precio_compra', 'precio_venta', 'stock', 'categoria_id', 'imagen', 'modo_editar']);
        $this->resetValidation();
    }

    public function render()
    {
        // Query fresca para evitar resultados cacheados
        $query = Producto::query()->with('categoria');

        if($this->search != '') {
            $query->where(function($q) {
                $q->where('nombre', 'like', '%'.$this->search.'%')
                  ->orWhere('codigo_barras', 'like', '%'.$this->search.'%');
            });
        }

        if($this->categoria != '') {
            $query->where('categoria_id', $this->categoria);
        }

        return view('livewire.productos-buscador', [
            'productos' => $query->orderBy('updated_at', 'desc')->get(),
            'categorias' => Categoria::all()
        ]);
    }
}