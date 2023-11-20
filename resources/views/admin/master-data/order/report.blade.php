<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Boneva</title>
    <style type="text/css">
        body {
            font-family: sans-serif;
            font-size: 12px;
            background-color: #ccc;
            margin: 0;
            padding: 0;
        }

        .rangkasurat {
            width: 100%;
            max-width: 980px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ccc;
        }

        .tengah {
            text-align: center;
            line-height: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="rangkasurat">
        <table style="border: none">
            <tr>
                <td><img src="{{ asset('assets/front/img/favicon.png') }}" width="140px" alt="Logo"></td>
                <td class="tengah">
                    <h2>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h2>
                    <h2>DINAS PENDIDIKAN</h2>
                    <h2>CABANG DINAS PENDIDIKAN WILAYAH VIII</h2>
                    <h1>SEKOLAH MENENGAH ATAS NEGERI JATINUNGGAL</h1>
                    <h1>SUMEDANG</h1>
                    <b>Jalan Tarikolot Jatinunggal Telp. (0262) 428590 Sumedang 45376</b>
                </td>
            </tr>
        </table>
        <div class="header">
            <h2>Laporan Penjualan Boneva</h2>
            <h3>KABUPATEN BONE BOLANGO</h3>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>NAMA Barang</th>
                    <th>Tipe Barang</th>
                    <th>Harga</th>
                    <th>Jumlah Terjual</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $orders = App\Models\Order::where('status', 'success')->get();
                    $catalogs = App\Models\Catalog::all();

                    $jumlah = [];

                    foreach ($catalogs as $item) {
                        $jumlah[$item->id] = 0;
                        foreach ($orders as $result) {
                            $json = json_decode($result->items, true);
                            try {
                                $jumlah[$item->id] += $json[$item->id];
                            } catch (\Throwable $th) {
                                // Handle exception if needed
                            }
                        }
                    }

                    $i = 0;
                @endphp

                @foreach ($catalogs as $item)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $jumlah[$item->id] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div></div>
</body>

</html>
