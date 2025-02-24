<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Preview Quote') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>{{ __('Raw Material Selected: ') }} {{ $rawMaterial->category->nombre }}</h3>
                    <h1>Vista previa de la cotización</h1>
                    <p><strong>Producto:</strong> {{ $categoria->nombre }}</p>
                    <p><strong>Proveedor:</strong> {{ $categoria->proveedor->nombre }}</p>
                    <p><strong>Precio:</strong> ${{ $categoria->precio }}</p>
                    <p><strong>Existencias restantes:</strong> {{ $categoria->existencias }}</p>

                    <form action="{{ route('quotes.generate', $categoria->id) }}" method="POST">
                        @csrf
                        <x-primary-button>
                            {{ __('Generar PDF') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
