@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('components/css/history.css') }}">
@endpush

@section('title', 'History')

@section('content')
<div class="title py-3">
    <h1>HISTORY</h1>
</div>

<div class="container py-2">
    <div class="row">
        <div class="col-lg-9 mx-auto bg-[#1f2937] rounded shadow w-[100%]">
            <div class="table-responsive">
                <table class="table text-white">
                    <thead>
                        <tr style="text-align:center;">
                            <th scope="col">No</th>
                            <th scope="col">Ticket Purchased</th>
                            <th scope="col">Ticket Category</th>
                            <th scope="col">Transaction Date</th>
                            <th scope="col">Total Transactions</th>
                            <th scope="col">Full name</th>
                            <th scope="col">No-KTP</th>
                            <th scope="col">Phone number</th>
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
    <div class="d-flex justify-content-center gap-2" style="width:100%;">
        @if($transaksi->status === 'pending')
            @if($transaksi->exp && \Carbon\Carbon::now()->greaterThan($transaksi->exp))
                <form action="{{ route('destroyTransaksi', $transaksi->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');" style="width:100%;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="width:100%;">Delete</button>
                </form>
            @else
              {{-- <a href="{{ 'https://app.sandbox.midtrans.com/snap/v4/redirection/' . $transaksi->snap_token }}"
            
   class="btn btn-warning btn-sm" 
   target="_blank">
   Lanjutkan Pembayaran
</a> --}}

  <button onclick="payWithSnap('{{ $transaksi->snap_token }}')">Bayar woi</button>

            @endif
        @elseif($transaksi->status === 'paid')
            @if($transaksi->tiket->kategori_tiket === 'online')
                <a href="{{ $transaksi->tiket->link_tiket }}" class="btn btn-success btn-sm" target="_blank" rel="noopener noreferrer" style="width:100%;">Join Zoom</a>
            @endif
            <a href="{{ route('downloadTiket', $transaksi->id) }}" class="btn btn-primary btn-sm" style="width:100%;">Download</a>
        @else
            <span class="text-danger">Status transaksi tidak valid.</span>
        @endif
    </div>
</td>



                        </tr>
                        @endforeach
                         
                    </tbody>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
          @endif

                </table>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>



<script>
    function payWithSnap(snapToken) {
        snap.pay(snapToken, {
            onSuccess: function(result) {
                alert('Pembayaran berhasil!');
                location.reload(); // refresh page to reflect new status
            },
            onPending: function(result) {
                alert('Pembayaran pending. Silakan selesaikan pembayaran Anda.');
            },
            onError: function(result) {
                console.error('Error:', result);
                alert('Pembayaran gagal.');
            },
            onClose: function() {
                alert('Anda menutup modal pembayaran tanpa menyelesaikan transaksi.');
            }
        });
    }

    @if (isset($snapToken))
        payWithSnap('{{ $snapToken }}');
    @endif
</script>




@endpush