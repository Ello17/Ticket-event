<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Tiket Event</title>
    <style>
        .receipt {
            max-width: 350px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .receipt h1 {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .receipt p {
            font-size: 0.9em;
            margin: 5px 0;
        }
        .receipt .total {
            font-weight: bold;
            margin-top: 15px;
        }
        .qrcode {
            text-align: center;
            margin-top: 15px;
        }

        .qrcode p {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .divider {
            border-top: 1px dashed #bbb;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="receipt">
    <h1>Tiket Event</h1>
    <p><strong>Kode Tiket:</strong> {{ $transaksi->kode_tiket }}</p>
    <p><strong>Nama Lengkap:</strong> {{ $transaksi->nama_lengkap }}</p>
    <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal_transaksi }}</p>
    <div class="divider"></div>
    <p class="total"><strong>Total Transaksi:</strong> {{ $transaksi->total_transaksi }}</p>
    <p><strong>Email:</strong> {{ $transaksi->email }}</p>

    <div class="qrcode">
        <p>QR Code:</p>
        {!! $qrcode !!}
    </div>
</div>

</body>
</html>


{{-- <!DOCTYPE html>
<html>
<head>
    <title>Tiket Event</title>
</head>
<body>
    <h1>Tiket Event</h1>
    <p>Kode Tiket: {{ $transaksi->kode_tiket }}</p>
    <p>Nama Lengkap: {{ $transaksi->nama_lengkap }}</p>
    <p>Tanggal Transaksi: {{ $transaksi->tanggal_transaksi }}</p>
    <p>Total Transaksi: {{ $transaksi->total_transaksi }}</p>
    <p>Email: {{ $transaksi->email }}</p>

    <div class="qrcode">
        <p><strong>QR Code:</strong></p>
        {!! $qrcode !!}
    </div>

    <!-- Barcode -->
    <div class="barcode">
        <p><strong>Barcode:</strong></p>
        {!! $barcode !!}
    </div> 
</body>
</html> --}}
