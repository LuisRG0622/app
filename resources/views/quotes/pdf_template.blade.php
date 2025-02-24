<!DOCTYPE html>
<html>
<head>
    <title>Quote PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>{{ __('Quote for Raw Material') }}</h2>
    </div>

    <table class="table">
        <tr>
            <th>{{ __('Name') }}</th>
            <td>{{ $rawMaterial->category->nombre }}</td>
        </tr>
        <tr>
            <th>{{ __('Diameter (mm)') }}</th>
            <td>{{ $rawMaterial->category->diametro_mm }}</td>
        </tr>
        <tr>
            <th>{{ __('Diameter (in)') }}</th>
            <td>{{ $rawMaterial->category->diametro_in }}</td>
        </tr>
        <tr>
            <th>{{ __('Supplier') }}</th>
            <td>{{ $rawMaterial->supplier->name }}</td>
        </tr>
        <tr>
            <th>{{ __('Price') }}</th>
            <td>${{ $rawMaterial->category->precio }}</td>
        </tr>
        <tr>
            <th>{{ __('Remaining Stock') }}</th>
            <td>{{ $rawMaterial->existencias }}</td>
        </tr>
    </table>

</body>
</html>
