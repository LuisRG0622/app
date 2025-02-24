<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Select Raw Material') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <table>
                    <thead>
                        <tr>
                            <th>Código Exterior</th>
                            <th>Código Interior</th>
                            <th>Nombre</th>
                            <th>Diámetros (mm / in)</th>
                            <th>Proveedor</th>
                            <th>Precio</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->codigo_exterior }}</td>
                                <td>{{ $categoria->codigo_interior }}</td>
                                <td>{{ $categoria->nombre }}</td>
                                <td>{{ $categoria->diametro_mm }} mm / {{ $categoria->diametro_in }} in</td>
                                <td>{{ $categoria->proveedor->nombre ?? 'N/A' }}</td>
                                <td>${{ $categoria->precio }}</td>
                                <td>
                                    <form action="{{ route('quotes.select', $categoria->id) }}" method="POST">
                                        @csrf
                                        <x-primary-button>
                                            {{ __('Seleccionar') }}
                                        </x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No hay categorías disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
