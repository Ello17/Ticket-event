<!DOCTYPE html>
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
    {{-- <div class="barcode">
        <p><strong>Barcode:</strong></p>
        {!! $barcode !!}
    </div> --}}
</body>
</html>
