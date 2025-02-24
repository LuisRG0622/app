<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Raw Material') }}
        </h2>

        <div class="flex space-x-4">
            <x-primary-button class="mt-4">
                <a href="{{ route('raw_material.create') }}" class="text-dark">
                    {{ __('Add New Material') }}
                </a>
            </x-primary-button>

            <x-primary-button class="mt-4">
                <a href="{{ route('categoria_producto.create') }}" class="text-dark">
                    {{ __('Add New Category') }}
                </a>
            </x-primary-button>
            <x-primary-button class="mt-4">
                <a href="{{ route('quotes.materialquote') }}" class="text-dark">
                    {{ __('Generate Material Quote') }}
                </a>
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table-auto border-collapse border border-gray-300 w-full">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Imagen Producto</th>
                            <th class="border border-gray-300 px-4 py-2">Código Exterior</th>
                            <th class="border border-gray-300 px-4 py-2">Código Interior</th>
                            <th class="border border-gray-300 px-4 py-2">Nombre</th>
                            <th class="border border-gray-300 px-4 py-2">Diámetro (mm)</th>
                            <th class="border border-gray-300 px-4 py-2">Diámetro (in)</th>
                            <th class="border border-gray-300 px-4 py-2">Diámetro (mm2)</th>
                            <th class="border border-gray-300 px-4 py-2">Existencias</th>
                            <th class="border border-gray-300 px-4 py-2">Precio</th>
                            <th class="border border-gray-300 px-4 py-2">Producto</th>
                            <th class="border border-gray-300 px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">
                                    <img src="{{ asset('storage/' . $categoria->producto->imagen) }}" 
                                        alt="Imagen Producto" 
                                        class="w-16 h-16 object-cover">
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $categoria->codigo_exterior }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $categoria->codigo_interior }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $categoria->nombre }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $categoria->diametro_mm }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $categoria->diametro_in }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $categoria->diametro_mm_2 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $categoria->existencias }}</td>
                                <td class="border border-gray-300 px-4 py-2">${{ number_format($categoria->precio, 2) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $categoria->producto->nombre ?? 'N/A' }}</td>
                                <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                    <x-primary-button>
                                        <a href="{{ route('categoria_producto.edit', $categoria->id) }}">
                                            {{ __('Edit Category') }}
                                        </a>
                                    </x-primary-button>
                                    <form action="{{ route('categoria_producto.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button>
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
