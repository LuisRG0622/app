<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización PDF</title>
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
        <h1>Cotización de Consolas Horizontales</h1>
        <p>Generado el {{ now()->format('Y-m-d') }}</p>
    </div>

    <!-- Detalles Generales -->
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

    <!-- Detalles de la Cotización -->
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
                <!-- Otros Campos -->
                @foreach(['work', 'width', 'length', 'length_price'] as $field)
                    @if(!empty($quote->$field))
                        <tr>
                            <td>{{ ucfirst(str_replace('_', ' ', $field)) }}</td>
                            <td>{{ is_numeric($quote->$field) ? '' . number_format($quote->$field, 0) : $quote->$field }}</td>
                        </tr>
                    @endif
                @endforeach

                <!-- Campos Dinámicos -->
                @foreach(['lighting', 'connection', 'gas', 'cga_v5', 'brands', 'accessories'] as $arrayField)
                    @if(!empty($quote->$arrayField))
                        <tr>
                            <td>{{ ucfirst(str_replace('_', ' ', $arrayField)) }}</td>
                            <td>
                                @php
                                    $items = is_array($quote->$arrayField) ? $quote->$arrayField : json_decode($quote->$arrayField, true);
                                    $items = array_filter($items ?? []);
                                @endphp
                                {{ implode(', ', $items) }}
                            </td>
                        </tr>
                    @endif
                @endforeach

                <!-- Precios para Campos Dinámicos -->
                @foreach(['lighting_price', 'connection_price', 'gas_price', 'cga_v5_price', 'brand_price', 'accessory_price'] as $priceField)
                    @if(!empty($quote->$priceField))
                        <tr>
                            <td>{{ ucfirst(str_replace('_', ' ', $priceField)) }}</td>
                            <td>
                                @php
                                    $prices = is_array($quote->$priceField) ? $quote->$priceField : json_decode($quote->$priceField, true);
                                    $prices = array_filter($prices ?? []);
                                @endphp
                                ${{ implode(', $', $prices) }}
                            </td>
                        </tr>
                    @endif
                @endforeach

                <!-- Subtotal, IVA, Descuento, Margen de Ganancia y Total -->
                @foreach(['subtotal', 'iva', 'discount', 'profit_margin', 'total'] as $finalField)
                    @if(!empty($quote->$finalField))
                        <tr>
                            <td>{{ ucfirst(str_replace('_', ' ', $finalField)) }}</td>
                            <td>{{ is_numeric($quote->$finalField) ? '$' . number_format($quote->$finalField, 2) : $quote->$finalField }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>¡Gracias por su preferencia!</p>
    </div>
</body>
</html>

