<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización de Materiales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f4f4f4;
        }
        .summary {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .summary label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Cotización de Materiales</h1>
    <p>Fecha: {{ now()->format('d/m/Y') }}</p>
    <p>Cliente: {{ $client->name }}</p>
</div>

<!-- Información del Cliente -->
<h2>Información del Cliente</h2>
<p><strong>Nombre:</strong> {{ $client->name }}</p>
<p><strong>ID Cliente:</strong> {{ $client->id }}</p>

<!-- Resumen de Materiales Seleccionados -->
<h2>Resumen de Materiales Seleccionados</h2>
<table class="table">
    <thead>
        <tr>
            <th>Código Exterior</th>
            <th>Código Interior</th>
            <th>Nombre</th>
            <th>Existencias</th>
            <th>Diámetro (mm)</th>
            <th>Precio Unitario</th>
            <th>Proveedor</th>
            <th>Producto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($materials as $material)
            <tr>
                <td>{{ $material->codigo_exterior }}</td>
                <td>{{ $material->codigo_interior }}</td>
                <td>{{ $material->nombre }}</td>
                <td>{{ $material->existencias }}</td>
                <td>{{ $material->diametro_mm }}</td>
                <td>${{ number_format($material->precio, 2) }}</td>
                <td>{{ $material->proveedor->nombre }}</td>
                <td>{{ $material->producto->nombre }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Rango de Venta y Descuento -->
<h2>Rango de Venta y Descuento</h2>
<p><strong>Rango de Venta:</strong> {{ $venta_rango }}%</p>
<p><strong>Descuento Aplicado:</strong> {{ $descuento }}%</p>

<!-- Resumen de la Cotización -->
<div class="summary">
    <p><label>Subtotal:</label> ${{ number_format($subtotal, 2) }}</p>
    <p><label>IVA (16%):</label> ${{ number_format($iva, 2) }}</p> <!-- Mostrar el IVA -->
    <p><label>Total con Rango de Venta:</label> ${{ number_format($total_con_rango, 2) }}</p> <!-- Mostrar total con rango de venta -->
    <p><label>Total con Descuento:</label> ${{ number_format($total_con_descuento, 2) }}</p>
</div>

<!-- Firma -->
<p><strong>Firma:</strong> __________________________</p>

<div class="footer">
    <p>Gracias por tu preferencia.</p>
</div>

</body>
</html>

