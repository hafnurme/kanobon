@inject('carbon', 'Carbon\Carbon')

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
            padding: 4px 6px;
        }

        td {
            border: 1px solid #121212;
            padding: 4px 6px
        }

        .id-cell {
            text-align: center;
            padding: 2px;
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
            @foreach ($data as $item)
            <tr>
                <td class="id-cell">{{$item['id']}}</td>
                <td>{{$carbon::parse($item['tanggal_penjualan'])->format('d M Y')}}</td>
                <td>{{$item['kode_transaksi']}}</td>
                <td>{{$item['harus_dibayar']}}</td>
                <td>{{$item['uang_dibayar']}}</td>
                <td>{{$item['kembalian']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>