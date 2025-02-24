<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generate Material Quote') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('quotes.storeMaterialQuote') }}" method="POST">
                    @csrf

                    <!-- Selección del cliente -->
                    <h3 class="text-lg font-semibold mb-4">Seleccionar Cliente</h3>
                    <select name="client_id" class="w-full border-gray-300 rounded-md shadow-sm mb-6" required>
                        <option value="">-- Seleccionar Cliente --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>

                    <!-- Tabla de materiales -->
                    <h3 class="text-lg font-semibold">Seleccionar Materiales</h3>
                    <table class="table-auto border-collapse border border-gray-300 w-full mt-4">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">Seleccionar</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Código Exterior</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Código Interior</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materials as $material)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <input type="checkbox" name="materials[]" value="{{ $material->id }}" class="material-checkbox">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $material->codigo_exterior }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $material->codigo_interior }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $material->nombre }}</td>
                                    <td class="border border-gray-300 px-4 py-2">${{ number_format($material->precio, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Selección de Rango de Venta -->
                    <h3 class="text-lg font-semibold mt-6">Seleccionar Rango de Venta</h3>
                    <select name="venta_rango" id="venta_rango" class="w-full border-gray-300 rounded-md shadow-sm mb-6" required>
                        <option value="">-- Seleccionar Rango de Venta --</option>
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

                    <!-- Selección de Descuento -->
                    <h3 class="text-lg font-semibold mt-6">Seleccionar Descuento</h3>
                    <select name="descuento" id="descuento" class="w-full border-gray-300 rounded-md shadow-sm mb-6" required>
                        <option value="">-- Seleccionar Descuento --</option>
                        <option value="0">0%</option>
                        <option value="10">10%</option>
                        <option value="20">20%</option>
                        <option value="30">30%</option>
                        <option value="40">40%</option>
                        <option value="50">50%</option>
                    </select>

                    <!-- Mostrar el subtotal calculado -->
                    <h3 class="text-lg font-semibold mt-6">Resumen de la Cotización</h3>
                    <div class="mb-4">
                        <label for="subtotal" class="block text-sm font-medium text-gray-700">Subtotal</label>
                        <input type="text" id="subtotal" name="subtotal" class="w-full border-gray-300 rounded-md shadow-sm" readonly>
                    </div>

                    <!-- Mostrar el IVA calculado -->
                    <div class="mb-4">
                        <label for="iva" class="block text-sm font-medium text-gray-700">IVA (16%)</label>
                        <input type="text" id="iva" name="iva" class="w-full border-gray-300 rounded-md shadow-sm" readonly>
                    </div>

                    <!-- Total a Pagar -->
                    <div class="mb-4">
                        <label for="total" class="block text-sm font-medium text-gray-700">Total a Pagar</label>
                        <input type="text" id="total" name="total" class="w-full border-gray-300 rounded-md shadow-sm" readonly>
                    </div>

                    <!-- Botón de envío -->
                    <div class="mt-6">
                        <x-primary-button>
                            {{ __('Generate Quote') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Función para actualizar subtotal, IVA, rango de venta, descuento y total a pagar
        const materialsCheckbox = document.querySelectorAll('.material-checkbox');
        const subtotalInput = document.getElementById('subtotal');
        const ivaInput = document.getElementById('iva');
        const ventaRangoSelect = document.getElementById('venta_rango');
        const descuentoSelect = document.getElementById('descuento');
        const totalInput = document.getElementById('total');

        const ivaPercentage = 16; // 16% de IVA

        materialsCheckbox.forEach(checkbox => {
            checkbox.addEventListener('change', updateQuoteSummary);
        });

        ventaRangoSelect.addEventListener('change', updateQuoteSummary);
        descuentoSelect.addEventListener('change', updateQuoteSummary);

        function updateQuoteSummary() {
            let subtotal = 0;
            materialsCheckbox.forEach(checkbox => {
                if (checkbox.checked) {
                    const materialPrice = parseFloat(checkbox.closest('tr').querySelectorAll('td')[4].innerText.replace('$', '').replace(',', ''));
                    subtotal += materialPrice;
                }
            });

            // Obtener el rango de venta y descuento seleccionados
            const ventaRango = parseFloat(ventaRangoSelect.value) || 0;
            const descuento = parseFloat(descuentoSelect.value) || 0;

            // Actualizar los campos de subtotal
            subtotalInput.value = '$' + subtotal.toFixed(2);

            // Calcular el IVA
            const iva = subtotal * (ivaPercentage / 100);
            ivaInput.value = '$' + iva.toFixed(2);

            // Calcular el subtotal con IVA
            const subtotalConIva = subtotal + iva;

            // Calcular el total con el rango de venta
            const totalConRango = subtotalConIva * (1 + ventaRango / 100);

            // Calcular el total con descuento
            const totalConDescuento = totalConRango * (1 - descuento / 100);

            // Mostrar el total a pagar
            totalInput.value = '$' + totalConDescuento.toFixed(2);
        }
    </script>
</x-app-layout>

