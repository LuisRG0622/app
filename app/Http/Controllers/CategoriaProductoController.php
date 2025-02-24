<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Producto;
use App\Models\CategoriaProducto;
use App\Models\RawMaterial;
use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;


class CategoriaProductoController extends Controller
{
    // Mostrar listado de categorías
    public function index()
    {
        $categorias = CategoriaProducto::all();
        return view('raw_material.index', compact('categorias'));

        
    }

    // Mostrar formulario de creación
    public function create()
    {
        $productos = Producto::all();  // Traemos todos los productos
        $suppliers = Supplier::all();  // Traemos todos los proveedores
        return view('categoria_producto.create', compact('productos', 'suppliers'));
    }

    // Guardar nueva categoría
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $validated = $request->validate([
            'codigo_exterior' => 'required|string',
            'codigo_interior' => 'required|string',
            'nombre' => 'required|string',
            'existencias' => 'required|integer',
            'diametro_mm' => 'required|numeric',
            'diametro_in' => 'required|numeric',
            'diametro_mm_2' => 'required|numeric',
            'proveedor_id' => 'required|exists:suppliers,id',
            'precio' => 'required|numeric',
            'producto_id' => 'required|exists:productos,id',
        ]);

        // Crear un nuevo registro en la tabla categoria_producto
        CategoriaProducto::create([
            'codigo_exterior' => $validated['codigo_exterior'],
            'codigo_interior' => $validated['codigo_interior'],
            'nombre' => $validated['nombre'],
            'existencias' => $validated['existencias'],
            'diametro_mm' => $validated['diametro_mm'],
            'diametro_in' => $validated['diametro_in'],
            'diametro_mm_2' => $validated['diametro_mm_2'],
            'proveedor_id' => $validated['proveedor_id'],
            'precio' => $validated['precio'],
            'producto_id' => $validated['producto_id'],  // Guardamos el producto seleccionado
        ]);

        return redirect()->route('raw_material.index')->with('success', 'Product Category Created Successfully!');
    }
    

    // Mostrar formulario de edición
    public function edit($id)
    {
        $categoria = CategoriaProducto::findOrFail($id);
        $suppliers = Supplier::all();
        $productos = Producto::all();
    
        return view('categoria_producto.edit', compact('categoria', 'suppliers', 'productos'));
    }
    
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo_exterior' => 'required|string|max:255',
            'codigo_interior' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'existencias' => 'required|integer|min:0',
            'diametro_mm' => 'required|numeric|min:0',
            'diametro_in' => 'required|numeric|min:0',
            'diametro_mm_2' => 'required|numeric|min:0',
            'proveedor_id' => 'required|exists:suppliers,id',
            'precio' => 'required|numeric|min:0',
            'producto_id' => 'required|exists:productos,id',
        ]);
    
        $categoria = CategoriaProducto::findOrFail($id);
        $categoria->update($request->all());
    
        return redirect()->route('raw_material.index')->with('success', 'Category updated successfully.');
    }
    
    // Eliminar categoría
    public function destroy($id)
    {
        CategoriaProducto::findOrFail($id)->delete();
        return redirect()->route('raw_material.index')->with('success', 'Category deleted successfully!');

    }

    public function rawMaterials()
    {
        return $this->hasMany(RawMaterial::class, 'categoria_id');
    }

    public function createMaterialQuote()
    {
        $clients = Client::all(); // Obtener todos los clientes
        $materials = CategoriaProducto::with('supplier', 'producto')->get(); // Incluir relaciones
    
        return view('raw_material.materialquote', compact('clients', 'materials'));
    }
    

    public function storeMaterialQuote(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'materials' => 'required|array',
            'materials.*' => 'exists:categoria_productos,id', // Validar que los materiales existan
        ]);
    
        // Obtener los materiales seleccionados
        $materials = CategoriaProducto::whereIn('id', $validated['materials'])->get();
    
        // Calcular el subtotal
        $subtotal = $materials->sum('precio');
    
        // Calcular el IVA (por ejemplo, 16%)
        $iva = $subtotal * 0.16;
    
        // Calcular el total
        $total = $subtotal + $iva;
    
        // Obtener el cliente
        $client = Client::find($validated['client_id']);
    
        // Crear el PDF con los datos de la cotización
        $pdf = Pdf::loadView('quotes.pdf', [
            'client' => $client,
            'materials' => $materials,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
        ]);
    
        // Descargar el PDF
        return $pdf->download('raw_material.pdf');
    }


}
