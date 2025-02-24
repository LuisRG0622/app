<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-lg font-bold text-gray-700">Cotización</h2>
            <form action="{{ route('quotes.update', $quote->id) }}" method="POST">
            @csrf
            @method('PUT')
                <!-- Encabezado de datos del cliente -->
                <div class="border p-4 mt-4">
                    <h3 class="text-md font-bold text-gray-700 mb-4">Datos del Cliente</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Selección del cliente -->
                        <div class="col-span-2">
                            <x-input-label for="client_id" :value="__('Select Client')" />
                            <select id="client_id" name="client_id" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="" disabled>{{ __('Choose a client') }}</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" @selected($quote->client_id == $client->id)>{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dirección -->
                        <div>
                            <x-input-label for="work" :value="__('Work Site')" />
                            <x-text-input id="work" name="work" type="text" value="{{ $quote->work }}" class="block w-full" placeholder="Enter work site address" />
                        </div>
                        <!-- Fecha de cotización -->
                        <div>
                            <x-input-label for="quote_date" :value="__('Quote Date')" />
                            <x-text-input id="quote_date" type="text" value="{{ \Carbon\Carbon::parse($quote->quote_date)->format('d/m/Y') }}" class="block w-full" disabled />
                        </div>
                    </div>
                </div>

                <!-- Medida -->
                <h3 class="text-lg font-bold mt-6 mb-4">Medida</h3>
                <div class="grid grid-cols-2 items-center gap-4">
                    <div>
                        <label for="width" class="font-medium">Ancho:</label>
                        <x-text-input id="width" name="width" value="{{ $quote->width }}" class="block w-full bg-gray-100" readonly />
                    </div>
                    <div>
                        <label for="length" class="font-medium">Largo:</label>
                        <x-text-input id="length" name="length" value="{{ $quote->length }}" class="block w-full" />
                    </div>
                </div>
                <div class="grid grid-cols-2 items-center gap-4 mt-4">
                    <label for="length_price" class="font-medium">Precio del largo:</label>
                    <x-text-input id="length_price" name="length_price" value="{{ $quote->length_price }}" class="block w-full" />
                </div>

                <!-- Iluminación -->
                <h3 class="text-lg font-bold mt-6 mb-4">Iluminación</h3>
                @foreach(['Sin iluminación', 'Iluminación de lectura con interruptor balancín', 'Iluminación de ambiente con interruptor balancín', 'Apagado a falso plafón'] as $index => $lighting)
                    <div class="grid grid-cols-2 items-center gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="lighting_{{ $index }}" name="lighting[]" value="{{ $lighting }}" class="mr-2" @checked(in_array($lighting, $quote->lighting ?? []))>
                            <label for="lighting_{{ $index }}">{{ $lighting }}</label>
                        </div>
                        <x-text-input 
                            name="lighting_price[]" 
                            value="{{ $quote->lighting_price[$index] ?? '' }}"
                            placeholder="Precio" 
                            type="number" 
                            step="0.01" 
                            class="block w-full" 
                        />
                    </div>
                @endforeach

                <!-- Conexión Eléctrica -->
                <h3 class="text-lg font-bold mt-6 mb-4">Conexión Eléctrica</h3>
                @foreach(['Contacto dúplex color naranja', 'Conector dúplex color rojo', 'Conector dúplex color blanco'] as $index => $connection)
                    <div class="grid grid-cols-2 items-center gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="connection_{{ $index }}" name="connection[]" value="{{ $connection }}" class="mr-2" @checked(in_array($connection, $quote->connection ?? []))>
                            <label for="connection_{{ $index }}">{{ $connection }}</label>
                        </div>
                        <x-text-input 
                            name="connection_price[]" 
                            value="{{ $quote->connection_price[$index] ?? '' }}"
                            placeholder="Precio" 
                            type="number" 
                            step="0.01" 
                            class="block w-full" 
                        />
                    </div>
                @endforeach

                <!-- Toma de Gases -->
                <h3 class="text-lg font-bold mt-6 mb-4">Toma de Gases</h3>
                @foreach(['OXY', 'AIR', 'VAC', 'NIT', 'CO', 'WAGD'] as $gas)
                    <div class="grid grid-cols-2 items-center gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="gas_{{ $gas }}" name="gas[]" value="{{ $gas }}" class="mr-2" @checked(in_array($gas, $quote->gas ?? []))>
                            <label for="gas_{{ $gas }}">{{ $gas }}</label>
                        </div>
                        <x-text-input 
                            name="gas_price[]" 
                            value="{{ $quote->gas_price[$loop->index] ?? '' }}"
                            placeholder="Precio" 
                            type="number" 
                            step="0.01" 
                            class="block w-full" 
                        />
                    </div>
                @endforeach

                <!-- Tipo de Conexión CGA V-5 -->
                <h3 class="text-lg font-bold mt-6 mb-4">Tipo de Conexión CGA V-5</h3>
                @foreach(['AGA', 'PURITAN B', 'DISS', 'CHEMETRON', 'OTRO'] as $connection)
                    <div class="grid grid-cols-2 items-center gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="cga_v5_{{ $connection }}" name="cga_v5[]" value="{{ $connection }}" class="mr-2" @checked(in_array($connection, $quote->cga_v5 ?? []))>
                            <label for="cga_v5_{{ $connection }}">{{ $connection }}</label>
                        </div>
                        <x-text-input 
                            name="cga_v5_price[]" 
                            value="{{ $quote->cga_v5_price[$loop->index] ?? '' }}"
                            placeholder="Precio" 
                            type="number" 
                            step="0.01" 
                            class="block w-full" 
                        />
                    </div>
                @endforeach

                <!-- Marca -->
                <h3 class="text-lg font-bold mt-6 mb-4">Marca</h3>
                @foreach(['ARAMED', 'AMICO', 'INFRA'] as $brand)
                    <div class="grid grid-cols-2 items-center gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="brand_{{ $brand }}" name="brands[]" value="{{ $brand }}" class="mr-2" @checked(in_array($brand, $quote->brands ?? []))>
                            <label for="brand_{{ $brand }}">{{ $brand }}</label>
                        </div>
                        <x-text-input 
                            name="brand_price[]" 
                            value="{{ $quote->brand_price[$loop->index] ?? '' }}"
                            placeholder="Precio" 
                            type="number" 
                            step="0.01" 
                            class="block w-full" 
                        />
                    </div>
                @endforeach

                <!-- Accesorios Adicionales -->
                <h3 class="text-lg font-bold mt-6 mb-4">Accesorios Adicionales</h3>
                @foreach(['Sistema de Inter conexión', 'canastillas', 'portavenoclisis', 'otro:'] as $accessory)
                    <div class="grid grid-cols-2 items-center gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="accessory_{{ $accessory }}" name="accessories[]" value="{{ $accessory }}" class="mr-2" @checked(in_array($accessory, $quote->accessories ?? []))>
                            <label for="accessory_{{ $accessory }}">{{ $accessory }}</label>
                        </div>
                        <x-text-input 
                            name="accessory_price[]" 
                            value="{{ $quote->accessory_price[$loop->index] ?? '' }}"
                            placeholder="Precio" 
                            type="number" 
                            step="0.01" 
                            class="block w-full" 
                        />
                    </div>
                @endforeach
            </form>
            <form action="{{ route('quotes.generatePdf', $quote->id) }}" method="GET">
                <x-primary-button class="mt-4">Generar PDF</x-primary-button>
            </form>

        </div>
    </div>
</x-app-layout>
