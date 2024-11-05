<!DOCTYPE html>
<html>
<head>
    <title>Tiket Event</title>
</head>
<body>
    <h1 style="text-align: center;">Tiket Event</h1>
    <p>Kode Tiket: {{ $transaksi->kode_tiket }}</p>

    <!-- Barcode -->
    <div class="barcode">
        <p><strong>Barcode:</strong></p>
        {!! DNS1D::getBarcodeHTML($transaksi->kode_tiket, 'C39') !!}
        <p>{{ $transaksi->kode_tiket }}</p>
    </div>

    <!-- QR Code -->
    <div class="qrcode">
        <p><strong>QR Code:</strong></p>
        <img src="data:image/png;base64,{{ $qrcodeBase64 }}" alt="QR Code">
    </div>
</body>
</html>
