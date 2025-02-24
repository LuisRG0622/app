<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('categoria_producto.update', $categoria->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Código Exterior -->
                    <div>
                        <x-input-label for="codigo_exterior" :value="__('Código Exterior')" />
                        <x-text-input id="codigo_exterior" class="block mt-1 w-full" type="text" name="codigo_exterior" value="{{ old('codigo_exterior', $categoria->codigo_exterior) }}" required />
                        <x-input-error :messages="$errors->get('codigo_exterior')" class="mt-2" />
                    </div>

                    <!-- Código Interior -->
                    <div>
                        <x-input-label for="codigo_interior" :value="__('Código Interior')" />
                        <x-text-input id="codigo_interior" class="block mt-1 w-full" type="text" name="codigo_interior" value="{{ old('codigo_interior', $categoria->codigo_interior) }}" required />
                        <x-input-error :messages="$errors->get('codigo_interior')" class="mt-2" />
                    </div>

                    <!-- Nombre -->
                    <div>
                        <x-input-label for="nombre" :value="__('Nombre')" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" required />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <!-- Existencias -->
                    <div>
                        <x-input-label for="existencias" :value="__('Existencias')" />
                        <x-text-input id="existencias" class="block mt-1 w-full" type="number" name="existencias" value="{{ old('existencias', $categoria->existencias) }}" required />
                        <x-input-error :messages="$errors->get('existencias')" class="mt-2" />
                    </div>

                    <!-- Diámetros -->
                    <div>
                        <x-input-label for="diametro_mm" :value="__('Diámetro (mm)')" />
                        <x-text-input id="diametro_mm" class="block mt-1 w-full" type="text" name="diametro_mm" value="{{ old('diametro_mm', $categoria->diametro_mm) }}" required />
                        <x-input-error :messages="$errors->get('diametro_mm')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="diametro_in" :value="__('Diámetro (in)')" />
                        <x-text-input id="diametro_in" class="block mt-1 w-full" type="text" name="diametro_in" value="{{ old('diametro_in', $categoria->diametro_in) }}" required />
                        <x-input-error :messages="$errors->get('diametro_in')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="diametro_mm_2" :value="__('Diámetro (mm2)')" />
                        <x-text-input id="diametro_mm_2" class="block mt-1 w-full" type="text" name="diametro_mm_2" value="{{ old('diametro_mm_2', $categoria->diametro_mm_2) }}" required />
                        <x-input-error :messages="$errors->get('diametro_mm_2')" class="mt-2" />
                    </div>

                    <!-- Proveedor -->
                    <div>
                        <x-input-label for="proveedor_id" :value="__('Proveedor')" />
                        <select id="proveedor_id" name="proveedor_id" class="block mt-1 w-full">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $categoria->supplier_id == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('proveedor_id')" class="mt-2" />
                    </div>

                    <!-- Precio -->
                    <div>
                        <x-input-label for="precio" :value="__('Precio')" />
                        <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio" value="{{ old('precio', $categoria->precio) }}" required />
                        <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                    </div>

                    <!-- Producto -->
                    <div>
                        <x-input-label for="producto_id" :value="__('Producto')" />
                        <select id="producto_id" name="producto_id" class="block mt-1 w-full">
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}" {{ $categoria->producto_id == $producto->id ? 'selected' : '' }}>
                                    {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('producto_id')" class="mt-2" />
                    </div>

                    <x-primary-button class="mt-4">
                        {{ __('Update Category') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
