

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EMAIL</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; color: #333;">
        <h2 style="color: #4CAF50;">Transaksi Berhasil!</h2>
        <p>Terima kasih, {{ $transaksi->nama_lengkap }}! Pembayaran Anda untuk event "{{ $transaksi->event->nama_event }}" telah berhasil.</p>

        <h3>Detail Tiket:</h3>
        <ul>
            <li><strong>Event:</strong> {{ $transaksi->event->nama_event }}</li>
            <li><strong>Jumlah Tiket:</strong> {{ $transaksi->tiket_dibeli }}</li>
            <li><strong>Total Harga:</strong> Rp {{ number_format($transaksi->total_transaksi, 0, ',', '.') }}</li>
        </ul>

        <p>Silakan cek history akun Anda untuk detail tiket atau tunjukkan email ini sebagai bukti saat acara berlangsung.</p>

        <p>Terima kasih telah mempercayakan layanan kami!</p>
    </div>

</body>
</html>

