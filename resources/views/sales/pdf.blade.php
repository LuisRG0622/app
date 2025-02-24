<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        h1, h2, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }
        .header, .footer {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Cotización #{{ $quote->id }}</h1>
        <p>Generado el {{ now()->format('Y-m-d') }}</p>
    </div>

    <!-- General Details -->
    <div class="section">
        <div class="section-title">Información del Cliente</div>
        <table>
            <tbody>
                @if(!empty($quote->client->name))
                    <tr><td>Nombre</td><td>{{ $quote->client->name }}</td></tr>
                @endif
                @if(!empty($quote->client->address))
                    <tr><td>Dirección</td><td>{{ $quote->client->address }}</td></tr>
                @endif
                @if(!empty($quote->client->phone))
                    <tr><td>Teléfono</td><td>{{ $quote->client->phone }}</td></tr>
                @endif
                @if(!empty($quote->client->email))
                    <tr><td>Correo Electrónico</td><td>{{ $quote->client->email }}</td></tr>
                @endif
                @if(!empty($quote->client->rfc))
                    <tr><td>RFC</td><td>{{ $quote->client->rfc }}</td></tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Quote Details -->
    <div class="section">
        <div class="section-title">Detalles de la Cotización</div>
        <table>
            <thead>
                <tr>
                    <th>Campo</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($quote->work))
                    <tr><td>Trabajo</td><td>{{ $quote->work }}</td></tr>
                @endif
                @if(!empty($quote->width))
                    <tr><td>Ancho</td><td>{{ $quote->width }}</td></tr>
                @endif
                @if(!empty($quote->length))
                    <tr><td>Largo</td><td>{{ $quote->length }}</td></tr>
                @endif
                @if(!empty($quote->length_price))
                    <tr><td>Precio por Largo</td><td>${{ number_format($quote->length_price, 2) }}</td></tr>
                @endif

                <!-- Lighting -->
                @if(!empty($quote->lighting))
                    <tr><td>Iluminación</td>
                        <td>
                            @php
                                $lighting = is_array($quote->lighting) ? $quote->lighting : json_decode($quote->lighting, true);
                                $lighting = array_filter($lighting ?? []);
                            @endphp
                            {{ implode(', ', $lighting) }}
                        </td>
                    </tr>
                @endif

                <!-- Lighting Price -->
                @if(!empty($quote->lighting_price))
                    <tr><td>Precio de Iluminación</td>
                        <td>
                            @php
                                $lightingPrices = is_array($quote->lighting_price) ? $quote->lighting_price : json_decode($quote->lighting_price, true);
                                $lightingPrices = array_filter($lightingPrices ?? []);
                            @endphp
                            ${{ implode(', $', $lightingPrices) }}
                        </td>
                    </tr>
                @endif

                <!-- Connection -->
                @if(!empty($quote->connection))
                    <tr><td>Conexión</td>
                        <td>
                            @php
                                $connections = is_array($quote->connection) ? $quote->connection : json_decode($quote->connection, true);
                                $connections = array_filter($connections ?? []);
                            @endphp
                            {{ implode(', ', $connections) }}
                        </td>
                    </tr>
                @endif

                <!-- Connection Price -->
                @if(!empty($quote->connection_price))
                    <tr><td>Precio de Conexión</td>
                        <td>
                            @php
                                $connectionPrices = is_array($quote->connection_price) ? $quote->connection_price : json_decode($quote->connection_price, true);
                                $connectionPrices = array_filter($connectionPrices ?? []);
                            @endphp
                            ${{ implode(', $', $connectionPrices) }}
                        </td>
                    </tr>
                @endif

                @if(!empty($quote->subtotal))
                    <tr><td>Subtotal</td><td>${{ number_format($quote->subtotal, 2) }}</td></tr>
                @endif
                @if(!empty($quote->iva))
                    <tr><td>IVA</td><td>${{ number_format($quote->iva, 2) }}</td></tr>
                @endif
                @if(!empty($quote->discount))
                    <tr><td>Descuento</td><td>{{ $quote->discount }}%</td></tr>
                @endif
                @if(!empty($quote->profit_margin))
                    <tr><td>Margen de Ganancia</td><td>{{ $quote->profit_margin }}%</td></tr>
                @endif
                @if(!empty($quote->total))
                    <tr><td>Total</td><td>${{ number_format($quote->total, 2) }}</td></tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>¡Gracias por su preferencia!</p>
    </div>
</body>
</html>
