<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los clientes y pasarlos a la vista
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar la vista de creación de cliente
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:clients,email',
            'rfc' => 'required|string|max:13',
        ]);
    
        // Crear un nuevo registro de cliente
        Client::create($request->only(['name', 'address', 'phone', 'email', 'rfc']));
    
        // Redireccionar con mensaje de éxito
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el cliente por ID y mostrar sus detalles
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el cliente por ID y mostrar la vista de edición
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:clients,email,' . $id,
            'rfc' => 'required|string|max:13',
        ]);
        
        // Actualizar el cliente
        $client = Client::findOrFail($id);
        $client->update($request->only(['name', 'address', 'phone', 'email', 'rfc']));
    
        // Redireccionar con mensaje de éxito
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar el cliente
        $client = Client::findOrFail($id);
        $client->delete();
    
        // Redireccionar con mensaje de éxito
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}

