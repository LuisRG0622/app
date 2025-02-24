<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Quote;
use App\Models\Sale; // Ajusta según tu modelo de ventas.
use Barryvdh\DomPDF\Facade\Pdf;


class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all(); // Obtén los clientes
        $quotes = Quote::with('client')->get(); // Obtén las cotizaciones con sus clientes relacionados
        $sales = Sale::where('assigned_to', auth()->id())->get();
        return view('sales.index', compact('clients', 'quotes','sales'));
 // Usa el nombre correcto de la vista
    }
    
    public function pdf(){
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtén todos los clientes
        $clients = Client::all();
    
        // Retorna la vista con los clientes
        return view('sales.create', compact('clients'));
    }
   
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'work' => 'required|string',
            'total' => 'required|numeric',
        ]);
    
        $sale = Sale::create([
            'client_id' => $validated['client_id'],
            'work' => $validated['work'],
            'total' => $validated['total'],
            'assigned_to' => auth()->id(), // Asigna la cotización al usuario actual
        ]);
    
        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sale = Sale::with('client')->where('id', $id)
            ->where('assigned_to', auth()->user()->id) // Filtrar por usuario autenticado
            ->firstOrFail(); // Lanzar error si no se encuentra o no es accesible
    
        return view('sales.show', compact('sale'));
    }
    
    
        

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sale = Sale::find($id); // Suponiendo que el modelo se llama Sale
        if (!$sale) {
            return redirect()->route('sales.index')->with('error', 'Sale not found');
        }
        return view('sales.edit', compact('sale'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->delete();
    
        return redirect()->route('sales.index')->with('success', 'Quote deleted successfully');
    }
    

    
    public function generatePDF($id)
    {
        $sale = Sale::with('materials', 'client')->findOrFail($id);
    
        $pdf = Pdf::loadView('sales.pdf', compact('sale'));
        return $pdf->download('quote-details.pdf');
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function getClientData($id)
{
    $client = Client::find($id);
    if ($client) {
        return response()->json($client);
    }
    return response()->json(['message' => 'Client not found'], 404);
}



}
