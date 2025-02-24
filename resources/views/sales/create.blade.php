<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-lg font-bold text-gray-700">Solicitud de Consola Médica Horizontal</h2>
            <form action="{{ route('quotes.store') }}" method="POST">
            @csrf    
                <!-- Encabezado de datos del cliente -->
                <div class="border p-4 mt-4">
                    <h3 class="text-md font-bold text-gray-700 mb-4">Datos del Cliente</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Selección del cliente -->
                        <div class="col-span-2">
                            <x-input-label for="client_id" :value="__('Select Client')" />
                            <select id="client_id" name="client_id" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="" selected disabled>{{ __('Choose a client') }}</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dirección -->
                        <div>
                            <x-input-label for="work" :value="__('Work Site')" />
                            <x-text-input id="work" name="work" type="text" class="block w-full" placeholder="Enter work site address" />
                        </div>
                        <!-- Fecha de cotización -->
                        <div>
                            <x-input-label for="quote_date" :value="__('Quote Date')" />
                            <x-text-input id="quote_date" type="text" value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" class="block w-full" disabled />
                        </div>
                    </div>
                </div>

                <!-- Medida -->
                <h3 class="text-lg font-bold mt-6 mb-4">Medida</h3>
                <div class="grid grid-cols-2 items-center gap-4">
                    <div>
                        <label for="width" class="font-medium">Ancho:</label>
                        <x-text-input id="width" name="width" value="38 cm (medida estándar)" class="block w-full bg-gray-100" readonly />
                    </div>
                    <div>
                        <label for="length" class="font-medium">Largo:</label>
                        <x-text-input id="length" name="length" placeholder="Ingrese el largo en metros" class="block w-full" />
                    </div>
                </div>
                <div class="grid grid-cols-2 items-center gap-4 mt-4">
                    <label for="length_price" class="font-medium">Precio del largo:</label>
                    <x-text-input id="length_price" name="length_price" placeholder="Precio" type="number" step="0.01" class="block w-full" />
                </div>

                <!-- Iluminación -->
                <h3 class="text-lg font-bold mt-6 mb-4">Iluminación</h3>
                @foreach(['Sin iluminación', 'Iluminación de lectura con interruptor balancín', 'Iluminación de ambiente con interruptor balancín', 'Apagado a falso plafón'] as $index => $lighting)
                    <div class="grid grid-cols-2 items-center gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="lighting_{{ $index }}" name="lighting[]" value="{{ $lighting }}" class="mr-2">
                            <label for="lighting_{{ $index }}">{{ $lighting }}</label>
                        </div>
                        <x-text-input 
                            name="lighting_price[]" 
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
                            <input type="checkbox" id="connection_{{ $index }}" name="connection[]" value="{{ $connection }}" class="mr-2">
                            <label for="connection_{{ $index }}">{{ $connection }}</label>
                        </div>
                        <x-text-input 
                            name="connection_price[]" 
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
                            <input type="checkbox" id="gas_{{ $gas }}" name="gas[]" value="{{ $gas }}" class="mr-2">
                            <label for="gas_{{ $gas }}">{{ $gas }}</label>
                        </div>
                        <x-text-input 
                            name="gas_price[]" 
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
                            <input type="checkbox" id="cga_v5_{{ $connection }}" name="cga_v5[]" value="{{ $connection }}" class="mr-2">
                            <label for="cga_v5_{{ $connection }}">{{ $connection }}</label>
                        </div>
                        <x-text-input 
                            name="cga_v5_price[]" 
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
                            <input type="checkbox" id="brand_{{ $brand }}" name="brands[]" value="{{ $brand }}" class="mr-2">
                            <label for="brand_{{ $brand }}">{{ $brand }}</label>
                        </div>
                        <x-text-input 
                            name="brand_price[]" 
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
                            <input type="checkbox" id="accessory_{{ $accessory }}" name="accessories[]" value="{{ $accessory }}" class="mr-2">
                            <label for="accessory_{{ $accessory }}">{{ $accessory }}</label>
                        </div>
                        <x-text-input 
                            name="accessory_price[]" 
                            placeholder="Precio" 
                            type="number" 
                            step="0.01" 
                            class="block w-full" 
                        />
                    </div>
                @endforeach
                <!-- Campos generales para cotización -->
                <h3 class="text-lg font-bold mt-6 mb-4">Datos de Cotización</h3>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Suma de precios -->
                    <div>
                        <x-input-label for="subtotal" :value="__('Subtotal')" />
                        <x-text-input id="subtotal" name="subtotal" type="text" class="block w-full bg-gray-100" readonly />
                    </div>

                    <!-- Campo para IVA -->
                    <div>
                        <x-input-label for="iva" :value="__('IVA (16%)')" />
                        <x-text-input id="iva" name="iva" type="text" class="block w-full bg-gray-100" readonly />
                    </div>

                    <!-- Descuento -->
                    <div>
                        <x-input-label for="discount" :value="__('Discount (%)')" />
                        <select id="discount" name="discount" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="0">0%</option>
                            <option value="10">10%</option>
                            <option value="20">20%</option>
                            <option value="30">30%</option>
                            <option value="40">40%</option>
                            <option value="50">50%</option>
                        </select>
                    </div>

                    <!-- Ganancia -->
                    <div>
                        <x-input-label for="profit_margin" :value="__('Profit Margin (%)')" />
                        <select id="profit_margin" name="profit_margin" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="10">10%</option>
                            <option value="20">20%</option>
                            <option value="30">30%</option>
                            <option value="40">40%</option>
                            <option value="50">50%</option>
                            <option value="60">60%</option>
                            <option value="70">70%</option>
                            <option value="80">80%</option>
                            <option value="90">90%</option>
                            <option value="100">100%</option>
                        </select>
                    </div>

                    <!-- Total -->
                    <div class="col-span-2">
                        <x-input-label for="total" :value="__('Total')" />
                        <x-text-input id="total" name="total" type="text" class="block w-full bg-gray-100 text-lg font-bold" readonly />
                    </div>
                </div>
                <div class="flex justify-between mt-6">
                    <!-- Botón adicional para enviar la cotización -->
                    <x-primary-button class="mt-4">
                        {{ __('Send to Quote History') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    <script>
         document.getElementById('client_id').addEventListener('change', function () {
            const selectedClientId = this.value;
            fetch(`/api/clients/${selectedClientId}`)
                .then(response => response.json())
                .then(data => {
                    // Rellenar los campos automáticamente
                    document.getElementById('client_name').value = data.name;
                    document.getElementById('client_phone').value = data.phone;
                    document.getElementById('client_rfc').value = data.rfc;
                    document.getElementById('client_email').value = data.email;
                });
        });
        document.addEventListener('DOMContentLoaded', () => {
    const prices = document.querySelectorAll('input[name="lighting_price[]"], input[name="connection_price[]"], input[name="gas_price[]"], input[name="cga_v5_price[]"], input[name="brand_price[]"], input[name="accessory_price[]"]');
    const widthPriceField = document.getElementById('length_price');  // Campo de precio de largo (podrías agregar un campo similar para el ancho si es necesario)
    const subtotalField = document.getElementById('subtotal');
    const ivaField = document.getElementById('iva');
    const totalField = document.getElementById('total');
    const discountField = document.getElementById('discount');
    const profitField = document.getElementById('profit_margin');

    function calculateTotals() {
        let subtotal = 0;

        // Calcular el subtotal sumando todos los precios manuales
        prices.forEach(price => {
            if (price.value) {
                subtotal += parseFloat(price.value);
            }
        });

        // Añadir el precio del ancho
        if (widthPriceField && widthPriceField.value) {
            subtotal += parseFloat(widthPriceField.value);  // Asegúrate de que este campo esté tomando el precio del ancho correctamente
        }

        // Aplicar descuento
        const discount = (subtotal * parseFloat(discountField.value)) / 100;
        const discountedSubtotal = subtotal - discount;

        // Calcular IVA
        const iva = discountedSubtotal * 0.16;

        // Aplicar margen de ganancia
        const profitMargin = (discountedSubtotal + iva) * (parseFloat(profitField.value) / 100);

        // Total final
        const total = discountedSubtotal + iva + profitMargin;

        // Actualizar campos
        subtotalField.value = subtotal.toFixed(2);
        ivaField.value = iva.toFixed(2);
        totalField.value = total.toFixed(2);
    }

    // Eventos para recalcular totales
    prices.forEach(price => {
        price.addEventListener('input', calculateTotals);
    });

    // Escuchar el cambio en el campo de precio del ancho
    widthPriceField.addEventListener('input', calculateTotals);

    discountField.addEventListener('change', calculateTotals);
    profitField.addEventListener('change', calculateTotals);
});

    </script>
</x-app-layout>