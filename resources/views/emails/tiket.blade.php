<!DOCTYPE html>
<html>
<head>
    <title>Tiket Event</title>
</head>
<body>
    <h1>Tiket Event</h1>
    <p>Kode Tiket: {{ $transaksi->kode_tiket }}</p>

    <div>
        {!! DNS1D::getBarcodeHTML($transaksi->kode_tiket, 'C39') !!}
    </div>
</body>
</html>
