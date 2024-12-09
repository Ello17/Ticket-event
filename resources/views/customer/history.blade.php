@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('components/css/history.css') }}">
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush

@section('title', 'History')

@section('content')
<div class="title py-3">
    <h1>HISTORY</h1>
</div>

<div class="container py-2">
    <div class="row">
        <div class="col-lg-9 mx-auto bg-[#1f2937] rounded shadow">
            <div class="table-responsive">
                <table class="table text-white">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">No</th>
                            <th scope="col">Ticket Purchased</th>
                            <th scope="col">Ticket Category</th>
                            <th scope="col">Transaction Date</th>
                            <th scope="col">Total Transactions</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">No-KTP</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($transaksiList as $index => $transaksi)
                        <tr>
                            <th scope="row" style="text-align: center;">{{ $index + 1 }}</th>
                            <td>{{ $transaksi->tiket_dibeli }}</td>
                            <td>{{ $transaksi->tiket->kategori_tiket }}</td>
                            <td>{{ $transaksi->tanggal_transaksi }}</td>
                            <td>{{ number_format($transaksi->total_transaksi, 0, ',', '.') }}</td>
                            <td>{{ $transaksi->nama_lengkap }}</td>
                            <td>{{ $transaksi->no_ktp }}</td>
                            <td>{{ $transaksi->no_telepon }}</td>
                            <td>{{ $transaksi->email }}</td>
                            <td>{{ $transaksi->status }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    @if($transaksi->status === 'pending' && $transaksi->snap_token)
                                        <button 
                                            class="btn btn-warning btn-sm pay-button" 
                                            data-snap-token="{{ $transaksi->snap_token }}">
                                            Pay
                                        </button>
                                    @elseif($transaksi->status === 'paid')
                                        <a href="{{ route('downloadTiket', $transaksi->id) }}" class="btn btn-primary btn-sm">Download</a>
                                    @else
                                        <form action="{{ route('destroyTransaksi', $transaksi->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    // Seleksi semua tombol dengan class 'pay-button'
    document.querySelectorAll('.pay-button').forEach(function(button) {
        button.addEventListener('click', function() {
            const snapToken = button.dataset.snapToken; // Ambil token dari data attribute
            if (!snapToken) {
                alert('Snap Token tidak tersedia');
                return;
            }
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    alert("Payment successful!");
                    console.log(result);
                    location.reload(); // Reload halaman setelah sukses
                },
                onPending: function(result) {
                    alert("Waiting for payment!");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    alert("You closed the popup without finishing the payment.");
                }
            });
        });
    });
</script>
@endpush
