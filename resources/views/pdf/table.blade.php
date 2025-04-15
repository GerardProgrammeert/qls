<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment order {{$order->id}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
    <body>
    <h2>Shipment order {{$order->id}}</h2>
    @if($fields)
        <table>
            <thead>
            <tr>
                @foreach($fields as $field)
                    <th>{{ ucwords(str_replace('_', ' ', $field)) }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($data as $row)
                <tr>
                    @foreach($fields as $field)
                        <td>{{ $row[$field] ?? '' }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p>No ordered products found.</p>
        @endif
    </body>
</html>
