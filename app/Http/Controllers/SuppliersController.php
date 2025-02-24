<?php

namespace App\Http\Controllers;

use App\Models\Supplier; // Asegúrate de tener el modelo Supplier
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all(); // Obtener todos los proveedores
        
        return view('suppliers.index', compact('suppliers')); // Pasar proveedores a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create'); // Mostrar el formulario de creación
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone_number' => 'required|string|max:15',
        ]);

        // Crear un nuevo proveedor en la base de datos
        Supplier::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
        ]);

        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('suppliers.index')->with('success', 'Proveedor registrado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el proveedor por ID
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id); // Obtener el proveedor por ID
        return view('suppliers.edit', compact('supplier')); // Mostrar el formulario de edición
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos actualizados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,'.$id,
            'phone_number' => 'required|string|max:15',
        ]);

        // Actualizar los datos del proveedor
        $supplier = Supplier::findOrFail($id);
        $supplier->update($validated);

        // Redirigir con mensaje de éxito
        return redirect()->route('suppliers.index')->with('success', 'Proveedor actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar el proveedor por ID
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('suppliers.index')->with('success', 'Proveedor eliminado con éxito.');
    }
}

