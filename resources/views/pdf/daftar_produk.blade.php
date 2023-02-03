<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif
        }

        table {
            width: 100%;
            height: fit-content;
            border-collapse: collapse
        }

        th {
            border: 1px solid #121212;
            padding: 0.5rem;
        }

        td {
            border: 1px solid #121212;
            padding: 0.5rem
        }

        .id-cell {
            text-align: center
        }
    </style>
</head>

<body>
    <h1>{{$heading_content}}</h1>
    <table>
        <thead>
            @foreach ($head as $tablehead)
            <th>{{ $tablehead }}</th>
            @endforeach
        </thead>
        <tbody>
            @foreach ($produk as $item)
            <tr>
                <td class="id-cell">{{$item['id']}}</td>
                <td>{{$item['nama_produk']}}</td>
                <td>{{$item['harga_satuan']}}</td>
                <td>{{$item['stok']}}</td>
                <td>{{$item['satuan']}}</td>
                <td>{{$item['stok_min']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>