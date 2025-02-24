<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Product Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('categoria_producto.store') }}">
                        @csrf

                        <!-- Código Exterior -->
                        <div class="mb-4">
                            <x-input-label for="codigo_exterior" :value="__('Exterior Code')" />
                            <x-text-input id="codigo_exterior" name="codigo_exterior" type="text" class="mt-1 block w-full" required />
                        </div>

                        <!-- Código Interior -->
                        <div class="mb-4">
                            <x-input-label for="codigo_interior" :value="__('Interior Code')" />
                            <x-text-input id="codigo_interior" name="codigo_interior" type="text" class="mt-1 block w-full" required />
                        </div>

                        <!-- Nombre -->
                        <div class="mb-4">
                            <x-input-label for="nombre" :value="__('Name')" />
                            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" required />
                        </div>

                        <!-- Medidas -->
                        <div class="mb-4">
                            <x-input-label for="existencias" :value="__('Existences')" />
                            <x-text-input id="existencias" name="existencias" type="number" class="mt-1 block w-full" required />
                        </div>

                        <!-- Diámetro (mm) -->
                        <div class="mb-4">
                            <x-input-label for="diametro_mm" :value="__('Diameter (mm)')" />
                            <x-text-input id="diametro_mm" name="diametro_mm" type="number" step="0.01" class="mt-1 block w-full" required />
                        </div>

                        <!-- Diámetro (in) -->
                        <div class="mb-4">
                            <x-input-label for="diametro_in" :value="__('Diameter (in)')" />
                            <x-text-input id="diametro_in" name="diametro_in" type="number" step="0.01" class="mt-1 block w-full" required />
                        </div>

                        <!-- Diámetro (mm²) -->
                        <div class="mb-4">
                            <x-input-label for="diametro_mm_2" :value="__('Diameter (mm²)')" />
                            <x-text-input id="diametro_mm_2" name="diametro_mm_2" type="number" step="0.01" class="mt-1 block w-full" required />
                        </div>

                        <!-- Producto -->
                        <div class="mb-4">
                            <x-input-label for="producto_id" :value="__('Select Product')" />
                            <select id="producto_id" name="producto_id" class="mt-1 block w-full">
                                <option value="">{{ __('Select a Product') }}</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Proveedor -->
                        <div class="mb-4">
                            <x-input-label for="proveedor" :value="__('Supplier')" />
                            <select id="proveedor" name="proveedor_id" class="block w-full mt-1">
                                <option value="">{{ __('Select a Supplier') }}</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Precio -->
                        <div class="mb-4">
                            <x-input-label for="precio" :value="__('Price ($)')" />
                            <x-text-input id="precio" name="precio" type="number" step="0.01" class="mt-1 block w-full" required />
                        </div>

                        <!-- Botón de guardar -->
                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
