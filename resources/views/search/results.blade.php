@extends('layouts.app')

@section('content')
    <h1>Resultados de búsqueda</h1>
    
    @if($results->isEmpty())
        <p>No se encontraron resultados para tu búsqueda.</p>
    @else
        <ul>
            @foreach ($results as $result)
                <li>{{ $result->name }} - {{ $result->description }}</li>
            @endforeach
        </ul>
    @endif
@endsection
