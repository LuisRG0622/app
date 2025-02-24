<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Client;
use App\Models\Sale;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\RawMaterial;
use App\Models\CategoriaProducto;
use App\Models\Quote;
use App\Models\Material;



class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all(); // Obtén los clientes
        $quotes = Quote::with('client')->get(); // Obtén las cotizaciones con sus clientes relacionados
    
        return view('sales.index', compact('clients', 'quotes'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'client_id' => 'required|exists:clients,id',
        'work' => 'nullable|string',
        'width' => 'nullable|string',
        'length' => 'nullable|numeric',
        'length_price' => 'nullable|numeric',
        'lighting' => 'array',
        'lighting_price' => 'array',
        'connection' => 'array',
        'connection_price' => 'array',
        'gas' => 'array',
        'gas_price' => 'array',
        'cga_v5' => 'array',
        'cga_v5_price' => 'array',
        'brands' => 'array',
        'brand_price' => 'array',
        'accessories' => 'array',
        'accessory_price' => 'array',
        'subtotal' => 'required|numeric',
        'iva' => 'required|numeric',
        'discount' => 'required|numeric',
        'profit_margin' => 'required|numeric',
        'total' => 'required|numeric',
    ]);

    $quote = Quote::create($validated);

    return redirect()->route('sales.index')
        ->with('success', __('Quote successfully saved to history.'));
}

    public function select($id)
    {
        $categoria = CategoriaProducto::findOrFail($id);

        if ($categoria->existencias > 0) {
            $categoria->decrement('existencias');
        } else {
            return redirect()->route('quotes.raw_materials')->with('error', 'No hay existencias suficientes.');
        }

        return redirect()->route('quotes.preview', $categoria->id);
    }

    public function preview($id)
    {
        $categoria = CategoriaProducto::with('proveedor')->findOrFail($id);
        return view('quotes.preview', compact('categoria'));
    }

    public function generate($id)
    {
        $categoria = CategoriaProducto::with('proveedor')->findOrFail($id);
        $pdf = PDF::loadView('quotes.pdf', compact('categoria'));
        return $pdf->download('cotizacion.pdf');
    }

public function showRawMaterials()
{
    $rawMaterials = RawMaterial::with('category', 'supplier')->get();

    return view('quotes.raw_materials', compact('rawMaterials'));
}

public function selectRawMaterial(RawMaterial $rawMaterial)
{
    // Descontar una unidad de las existencias de la materia prima
    if ($rawMaterial->existencias > 0) {
        $rawMaterial->decrement('existencias');
    } else {
        return redirect()->route('quotes.raw_materials')->with('error', 'No hay suficiente stock de esta materia prima.');
    }

    // Redirigir a la vista previa con los datos de la materia prima seleccionada
    return redirect()->route('quotes.preview', $rawMaterial->id);
}


public function create()
{
    $clients = Client::all(); // Reemplaza 'Client' por el nombre exacto de tu modelo.
    return view('sales.create', compact('clients')); // Asegúrate de que 'sales.create' sea la ruta correcta de la vista.
}

public function edit($id)
{
    $quote = Quote::findOrFail($id);
    $clients = Client::all(); // Para que puedas seleccionar un cliente

    return view('quotes.edit', compact('quote', 'clients'));
}

public function update(Request $request, $id)
{
    // Encuentra la cotización con el ID proporcionado
    $quote = Quote::findOrFail($id);

    // Valida los datos del formulario
    $validated = $request->validate([
        'client_id' => 'required|exists:clients,id',
        'work' => 'required|string',
        'quote_date' => 'required|date',
        'width' => 'required|numeric',
        'length' => 'required|numeric',
        'length_price' => 'required|numeric',
        'lighting' => 'nullable|array',
        'lighting_price' => 'nullable|array',
        'connection' => 'nullable|array',
        'connection_price' => 'nullable|array',
        'gas' => 'nullable|array',
        'gas_price' => 'nullable|array',
        'cga_v5' => 'nullable|array',
        'cga_v5_price' => 'nullable|array',
        'brands' => 'nullable|array',
        'brand_price' => 'nullable|array',
        'accessories' => 'nullable|array',
        'accessory_price' => 'nullable|array',
    ]);

    // Actualiza los campos de la cotización
    $quote->update([
        'client_id' => $request->client_id,
        'work' => $request->work,
        'quote_date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->quote_date)->format('Y-m-d'),
        'width' => $request->width,
        'length' => $request->length,
        'length_price' => $request->length_price,
        'lighting' => $request->lighting ?? [],
        'lighting_price' => $request->lighting_price ?? [],
        'connection' => $request->connection ?? [],
        'connection_price' => $request->connection_price ?? [],
        'gas' => $request->gas ?? [],
        'gas_price' => $request->gas_price ?? [],
        'cga_v5' => $request->cga_v5 ?? [],
        'cga_v5_price' => $request->cga_v5_price ?? [],
        'brands' => $request->brands ?? [],
        'brand_price' => $request->brand_price ?? [],
        'accessories' => $request->accessories ?? [],
        'accessory_price' => $request->accessory_price ?? [],
    ]);

    // Redirige al índice de ventas con mensaje de éxito
    return redirect()->route('sales.index')->with('success', 'Cotización actualizada exitosamente.');
}



public function generatePdf($id)
{
    \Log::info('Generando PDF para Quote ID: ' . $id);

    $quote = Quote::with('client')->find($id);

    if (!$quote) {
        \Log::error('Quote no encontrado: ' . $id);
        abort(404, 'Quote not found');
    }

    $pdf = Pdf::loadView('quotes.pdf', compact('quote'));
    \Log::info('PDF generado con éxito');
    return $pdf->download('quote_' . $quote->id . '.pdf');
}

public function createMaterialQuote()
{
    $clients = Client::all(); // Obtener todos los clientes
    $materials = CategoriaProducto::all(); // Obtener todos los materiales disponibles

    return view('raw_material.materialquote', compact('clients', 'materials'));
}

public function storeMaterialQuote(Request $request)
{
    // Validar los datos enviados desde el formulario
    $validated = $request->validate([
        'client_id' => 'required|exists:clients,id',
        'materials' => 'required|array',
        'materials.*' => 'exists:categoria_productos,id',
        'venta_rango' => 'required|numeric',
        'descuento' => 'required|numeric',
    ]);

    // Obtener los materiales seleccionados
    $materials = CategoriaProducto::whereIn('id', $validated['materials'])->get();

    // Calcular el subtotal
    $subtotal = $materials->sum('precio');

    // Calcular el IVA (por ejemplo, 16%)
    $iva = $subtotal * 0.16;

    // Calcular el total con IVA
    $total = $subtotal + $iva;

    // Obtener el rango de venta y el descuento seleccionados
    $venta_rango = $validated['venta_rango']; // Por ejemplo, 10% o 20%
    $descuento = $validated['descuento']; // Descuento en porcentaje, por ejemplo, 10%

    // Calcular el total con el rango de venta
    $total_con_rango = $total * (1 + $venta_rango / 100);

    // Aplicar el descuento como porcentaje
    $total_con_descuento = $total_con_rango * (1 - $descuento / 100);

    // Obtener el cliente
    $client = Client::find($validated['client_id']);

    // Crear el PDF con los datos de la cotización
    $pdf = Pdf::loadView('raw_material.pdf', [
        'client' => $client,
        'materials' => $materials,
        'subtotal' => $subtotal,
        'iva' => $iva,
        'total' => $total,
        'total_con_rango' => $total_con_rango, // Agregar el total con rango de venta
        'venta_rango' => $venta_rango,
        'descuento' => $descuento,
        'total_con_descuento' => $total_con_descuento,
    ]);

    // Descargar el PDF
    return $pdf->download('cotizacion_materiales.pdf');
}





    
}


