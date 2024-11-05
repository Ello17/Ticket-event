@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaksi Berhasil!</h2>
    <p>Terima kasih, {{ $transaksi->nama_lengkap }}! Pembayaran Anda untuk event "{{ $transaksi->event->nama }}" telah berhasil.</p>

    <h3>Detail Tiket:</h3>
    <ul>
        <li>Event: {{ $transaksi->event->nama_event }}</li>
        <li>Jumlah Tiket: {{ $transaksi->tiket_dibeli }}</li>
        <li>Total Harga: Rp {{ number_format($transaksi->total_transaksi, 0, ',', '.') }}</li>
    </ul>

    <p>Silakan cek history untuk detail Tiket.</p>
</div>
@endsection
    