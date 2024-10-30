<!DOCTYPE html>
<html>
<head>
    <title>Tiket Event</title>
</head>
<body>
    <h1 style="text-align: center;">Tiket Event</h1>
    <p>Kode Tiket: {{ $transaksi->kode_tiket }}</p>

    <div class="code">
        {!! DNS1D::getBarcodeHTML($transaksi->kode_tiket, 'C39',1,23,'green') !!}
    </div>
</body>
</html>
