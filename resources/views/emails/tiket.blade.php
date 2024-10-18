<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Event Anda</title>
</head>
<body>
    <h1>Halo, {{ $customer->name }}</h1>
    <p>Berikut adalah tiket untuk event yang telah Anda pesan:</p>
    <p>Kategori Tiket: {{ $tiket->kategori_tiket }}</p>
    <p>Harga Tiket: Rp {{ number_format($tiket->harga_tiket, 0, ',', '.') }}</p>
    <p>Event: {{ $tiket->event->nama_event }}</p>

    <p>Terima kasih telah memilih event kami. Sampai jumpa di acara!</p>
</body>
</html>
