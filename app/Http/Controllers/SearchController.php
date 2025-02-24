<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Modelo de Usuario
use App\Models\InterfaceData; // Modelo de la entidad que almacena los datos de las interfaces

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Validar que se haya proporcionado una consulta de búsqueda
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Obtener la consulta de búsqueda
        $query = $request->input('query');

        // Filtrar los datos relevantes solo en las interfaces a las que el usuario tiene acceso
        $results = InterfaceData::where('user_id', $user->id)
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->get();

        // Devolver los resultados a la vista de resultados de búsqueda
        return view('search.results', compact('results'));
    }
}
