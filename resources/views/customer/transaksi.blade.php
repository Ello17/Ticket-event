@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('components/css/transaksi.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-VlcG7DV3_odk4Alv"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush

@section('title', 'TMD')

@section('content')
    <div class="container-view">
        <form action="{{ route('transaksi.create') }}" id="payment-form" method="POST" class="form-group" enctype="multipart/form-data">
            @csrf
            <div class="box-detail">
                <div class="title">
                    <h2>Order Details</h2>
                </div>
                <div class="border">
                    <div class="box">
                        <img src="{{ asset($event->cover_event) }}" alt="poster--{{ $event->nama_event }}">
                        <div class="text-detail">
                            <h3>{{ $event->nama_event }}</h3>
                            <small><i class="fa-solid fa-calendar-days"></i> {{ $event->tanggal_event }}</small><br>
                            <small><i class="fa-regular fa-clock"></i> {{ $event->waktu_event }}</small><br>
                            <small><i class="fa-solid fa-location-dot"></i> {{ $event->lokasi_event }}</small><br>
                            <small>Available : {{ $tiket->jumlah_tiket }} Tickets</small>
                        </div>
                    </div>

                    <div class="container-detail">
                        <div class="jenis-tiket">
                            <h3>Ticket Type</h3>
                            <h3><img src="{{ asset('components/asset/img/ticket.png') }}" alt=""> {{ $tiket->kategori_tiket }}</h3>
                        </div>
                        <div class="jumlah-harga">
                            <div class="harga-tiket">
                                <h3>Price</h3>
                                <h3 class="harga">Rp{{ $tiket->harga_tiket }}</h3>
                            </div>
                            <div class="jumlah-tiket">
                                <h3>Amount</h3>
                                <h3>x{{ $tiket_dibeli }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-detail box-pemesan">
                <div class="title">
                    <h2>Orderer Details</h2>
                </div>
                @if ($tiket)
                <div class="form-group">
                    <input class="form-control" type="hidden" id="tiket_id" value="{{ $tiket->id }}" name="tiket_id" required>
                    <input class="form-control" type="hidden" id="user_id" value="{{ auth()->user()->id }}" name="user_id" required>
                    <input class="form-control" type="hidden" id="kategori_tiket" value="{{ $tiket->kategori_tiket }}" name="kategori_tiket" required>
                    <input class="form-control" type="hidden" id="tiket_dibeli" value="{{ $tiket_dibeli }}" name="tiket_dibeli" required>
                    <input class="form-control" type="hidden" id="status" value="{{ $status }}" name="status" required>                    
                    <input class="form-control" type="hidden" id="expire_time" value="{{ $expire_time }}" name="expire_time" required>                              
                </div>
                @else
                <p>Tickets Not found</p>
                @endif

                <div class="border column">
                    <div class="group">
                        <label for="name">Full Name :</label>
                        <input class="form-control input-transaksi" type="text" id="name" value="{{ $user->username }}" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Email :</label>
                        <input class="input-transaksi" type="email" id="email" value="{{ $user->email }}" name="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">No. KTP :</label>
                        <input class="input-transaksi" type="text" id="no_ktp" name="no_ktp" required>
                        <small>Must be 16 digits.</small>
                    </div>
                    <div class="form-group">
                        <label for="name">Phone Number :</label>
                        <input class="form-control input-transaksi" type="tel" id="phone" value="{{ $user->no_telepon }}" name="no_telepon" pattern="\d{10,15}" required>
                        <small>Must be between 10-15 digits.</small>
                    </div>
                </div>

                <div class="box-btn">
                    <button class="btn" id="pay-button">PAY NOW</button>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
@endsection

@push('js')
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        window.snap.embed('$snapToken', {
            embedId: 'snap-container',
            onSuccess: function(result) {
                alert("payment success!");
                console.log(result);
            },
            onPending: function(result) {
                alert("waiting your payment!");
                console.log(result);
            },
            onError: function(result) {
                alert("payment failed!");
                console.log(result);
            },
            onClose: function() {
                alert('you closed the popup without finishing the payment');
            }
        });
    });
</script>
@endpush
