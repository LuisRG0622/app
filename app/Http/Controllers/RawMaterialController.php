<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RawMaterial; // Modelo de Materiales
use App\Models\Supplier; // Modelo de Proveedores
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RawMaterialImport;
use App\Models\Tipo; // Importamos el modelo Tipo
use App\Models\CategoriaProducto; // Importamos el modelo CategoriaProducto
use App\Models\Producto;
use App\Models\Quote;

class RawMaterialController extends Controller
{
    /**
     * Mostrar el listado de materias primas.
     */
    public function index()
    {
        
        $rawMaterials = CategoriaProducto::with(['producto', 'proveedor',])->get();
        $producto = CategoriaProducto::with(['producto', 'proveedor'])->paginate(10);
        $tipos = CategoriaProducto::all();
        $categorias = CategoriaProducto::with('producto')->get();
        return view('raw_material.index', compact('rawMaterials','producto', 'tipos','categorias'));
        
        

    }
    

    /**
     * Mostrar el formulario de creación de materia prima.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $tipos = Tipo::all(); // Carga todos los tipos
        $categorias = CategoriaProducto::all(); // Carga todas las categorías
        return view('raw_material.create', compact('suppliers', 'tipos', 'categorias'));

        
    }

    /**
     * Almacenar una nueva materia prima.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'id_tipo' => 'required|exists:tipos,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación para la imagen
        ]);
    
        // Verificar si se ha subido una imagen
        if ($request->hasFile('imagen')) {
            // Almacenar la imagen en el directorio 'public/images'
            $imagenPath = $request->file('imagen')->store('images', 'public');
        } else {
            $imagenPath = null; // Si no se sube imagen, no guardarla
        }
    
        // Crear el producto en la base de datos
        Producto::create([
            'nombre' => $request->nombre,
            'id_tipo' => $request->id_tipo,
            'imagen' => $imagenPath, // Guardar la ruta de la imagen
        ]);
    
        return redirect()->route('raw_material.index')->with('success', 'Producto creado correctamente');
    }
    

    /**
     * Mostrar los detalles de una materia prima específica.
     */
    public function show($id)
    {
        $material = RawMaterial::with(['tipo', 'categoria'])->findOrFail($id); // Incluye relaciones
        return view('raw_material.show', compact('material'));
    }

    /**
     * Mostrar el formulario para editar una materia prima.
     */
    public function edit($id)
    {
        $material = RawMaterial::findOrFail($id);
        $suppliers = Supplier::all();
        $tipos = Tipo::all(); // Carga todos los tipos
        $categorias = CategoriaProducto::all(); // Carga todas las categorías

        return view('raw_material.edit', compact('material', 'suppliers', 'tipos', 'categorias'));
    }

    /**
     * Actualizar una materia prima existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_tipo' => 'required|exists:tipos,id',
            'id_categoria' => 'required|exists:categoria_productos,id',
        ]);

        $material = RawMaterial::findOrFail($id);

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('images/raw_materials', 'public');
            $material->imagen = $imagePath;
        }

        $material->update([
            'nombre' => $request->nombre,
            'id_tipo' => $request->id_tipo,
            'id_categoria' => $request->id_categoria,
        ]);

        return redirect()->route('raw_material.index')->with('success', 'Raw Material updated successfully!');
    }

    /**
     * Eliminar una materia prima.
     */
    public function destroy($id)
    {
        $material = RawMaterial::findOrFail($id);
        $material->delete();

        return redirect()->route('raw_material.index')->with('success', 'Raw Material deleted successfully!');
    }
    public function createCategoria()
    {
        // Asegúrate de que $suppliers contenga los datos necesarios
        $suppliers = Supplier::all(); // O la lógica correspondiente para obtener los proveedores
        $tipos = Tipo::all(); // Si también necesitas los tipos
    
        return view('raw_material.categoria_producto.create', compact('suppliers', 'tipos'));
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function createCotizacion($id)
    {
        // Obtén el material seleccionado
        $material = CategoriaProducto::with(['producto', 'proveedor'])->findOrFail($id);

        // Crear la cotización (puedes agregar más detalles según tu lógica)
        $quote = Quote::create([
            'material_id' => $material->id,
            'nombre' => $material->nombre,
            'precio' => $material->producto->precio ?? 0, // Precio del producto
            'proveedor' => $material->proveedor->name ?? 'N/A', // Nombre del proveedor
            'cantidad' => 1, // Puedes ajustar la cantidad según tu formulario
            'estado' => 'pendiente', // Estado inicial
        ]);

        // Redirige a la vista de cotización creada
        return redirect()->route('raw_material.showCotizacion', $quote->id)
                         ->with('success', 'Cotización creada exitosamente.');
    }

    /**
     * Mostrar la cotización generada.
     */
    public function showCotizacion($quoteId)
    {
        // Obtén los detalles de la cotización
        $quote = Quote::findOrFail($quoteId);
        return view('raw_material.cotizacion.show', compact('quote'));
    }

    

    
}