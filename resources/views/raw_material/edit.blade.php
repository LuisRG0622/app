<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Raw Material') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('raw_material.update', $material->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="nombre" :value="__('Name')" />
                            <x-text-input id="nombre" name="nombre" type="text" value="{{ $material->nombre }}" class="block mt-1 w-full" required />
                            @error('nombre')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="imagen" :value="__('Image')" />
                            <input type="file" id="imagen" name="imagen" class="block mt-1 w-full" />
                            @if ($material->imagen)
                                <img src="{{ asset('storage/' . $material->imagen) }}" alt="Current Image" class="mt-2 h-20">
                            @endif
                            @error('imagen')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="id_tipo" :value="__('Type')" />
                            <select id="id_tipo" name="id_tipo" class="block mt-1 w-full">
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id }}" {{ $material->id_tipo == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                            @error('id_tipo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <x-input-label for="id_categoria" :value="__('Category')" />
                            <select id="id_categoria" name="id_categoria" class="block mt-1 w-full">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $material->id_categoria == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                            @error('id_categoria')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <x-primary-button class="mt-4">{{ __('Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



