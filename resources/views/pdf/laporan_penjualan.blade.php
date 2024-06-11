<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #75AC34;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav {
            text-align: center;
            margin-top: 10px;
        }

        nav a {
            color: #75AC34;
            text-decoration: none;
            margin: 0 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            background-color: #75AC34;
        }
    </style>
</head>

<body>
    <header>
        <h1>Laporan Penjualan</h1>
        <nav>
            <h3>Batra Herbal Sri Mastuti</h3>
        </nav>
    </header>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Kuantiti</th>
                    <th>Harga Satuan</th>
                    <th>Harga Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporanPenjualan as $laporan)
                <tr>
                    <td>{{ $laporan['nama_obat'] }}</td>
                    <td>{{ $laporan['kuantitas'] }}</td>
                    <td>{{ $laporan['harga_satuan'] }}</td>
                    <td>{{ $laporan['harga_total'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <hr>
            <p>Tanggal: {{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}</p>
            <p>Batra Herbal Sri Mastuti</p>
        </div>
    </div>
</body>

</html>