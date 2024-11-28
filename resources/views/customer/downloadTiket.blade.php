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
            text-align: center;
        }
        .receipt h2 {
            font-size: 1.3em;
            margin-bottom: 10px;
        }
        .receipt p {
            font-size: 0.9em;
            margin: 5px 0;
        }
        .receipt .divider {
            border-top: 1px dashed #bbb;
            margin: 15px 0;
        }
        .receipt .qrcode {
            margin-top: 15px;
            display: flex;
            justify-content: center !important; /* Memusatkan QR code */
            align-items: center;
            margin: auto !important;
        }
        .qrcode img {
            max-width: 100px;
            height: auto;
        }
        .page-break {
            page-break-after: always;
        }
        @media print {
            .qrcode {
                display: flex !important;
                justify-content: center !important; /* Memusatkan QR code saat dicetak */
                page-break-inside: avoid !important; /* Menghindari pemisahan QR code saat dicetak */
            }
        }
    </style>
</head>
<body>
    @foreach ($qrcodes as $index => $qrcode)
        <div class="receipt">
            <h2>Struk Tiket Event</h2>
            <p>Nama Lengkap: {{ $transaksi->nama_lengkap }}</p>
            <p>Email: {{ $transaksi->email }}</p>
            <p>No. KTP: {{ $transaksi->no_ktp }}</p>
            <p>No. Telepon: {{ $transaksi->no_telepon }}</p>
            <p>Kode Tiket: {{ $transaksi->kode_tiket }} - {{ $index + 1 }}</p>

            @if ($transaksi->tiket->kategori_tiket !== 'online')
                <div class="divider"></div>

                <div class="qrcode">
                    <p>Scan QR Code Anda:</p>
                    {!! $qrcode !!}
                </div>
            @endif
        </div>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
