<x-guest-layout>
<form method="POST" action="{{ route('raw_material.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Nombre del producto -->
    <x-input-label for="nombre" :value="__('Nombre del Producto')" />
    <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" required />

    <!-- Imagen -->
    <x-input-label for="imagen" :value="__('Imagen del Producto')" />
    <input id="imagen" class="block mt-1 w-full" type="file" name="imagen" />

    <!-- Tipo -->
    <x-input-label for="tipo" :value="__('Tipo')" />
    <select id="tipo" name="id_tipo" class="block mt-1 w-full" required>
        @foreach($tipos as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
        @endforeach
    </select>

    <x-primary-button class="mt-4">{{ __('Guardar') }}</x-primary-button>
</form>

</x-guest-layout>
