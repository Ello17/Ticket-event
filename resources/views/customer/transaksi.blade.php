<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TMD</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-6.5.2-web/css/all.min.css') }}">
  <script type="text/javascript"
  src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-VlcG7DV3_odk4Alv"></script>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>
</head>
<style>
    @font-face {
        font-family: 'coolvetica rg';
        src: url('/fonts/coolvetica rg.otf') format('opentype');
    }

    * {
        font-family: 'coolvetica rg', sans-serif;
        font-size: 1rem;
    }

    .card {
        border: none;
        background-color: #f6f6f6;
    }

    .card-img-top {
        border-radius: 10px;
    }

    .card-text {
        margin-top: 30px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 0.8rem;
    }

    input[type="text"], input[type="email"], input[type="tel"] {
        border: groove;
        background: transparent;
        border: 2px solid rgb(255, 255, 255);
        width: 90%;
        text-align: center;
    }

    .form-group {
        justify-content: space-evenly;
        margin-left: 30px;
    }
</style>
<body class="bg bg-dark">
    <div class="container mt-4">
        <div class="row">
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-body border rounded bg-dark">
                        <h2 class="text-center text-white">Transaksi</h2>
                        <form action="{{ route('transaksi.create') }}" id="payment-form" method="POST" class="form-group" enctype="multipart/form-data">

                            @csrf

                            {{-- Validasi apakah tiket ditemukan --}}
                            @if ($tiket)
                            <input type="hidden" id="tiket_id" name="tiket_id" value="{{ $tiket->id }}" required>
                            <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}" required>
                                <input type="hidden" id="kategori_tiket" name="kategori_tiket" value="{{ $tiket->kategori_tiket }}" required>
                                <input type="hidden" id="tiket_dibeli" name="tiket_dibeli" value="{{ $tiket_dibeli }}" required>
                                <input type="hidden" id="status" name="status" value="{{ $status }}" required>
                                <p class="text-gray-400">Ketersediaan: {{ $tiket->jumlah_tiket }}</p>

                            @else
                                <p class="text-white">Tiket tidak ditemukan.</p>
                            @endif

                            <div class="form-group text-white">
                                <label for="name">Nama Lengkap :</label>
                                <input type="text" id="name" value="{{ $user->nama_lengkap }}" name="nama_lengkap" class="form-control text-white bg-dark text-start" required>
                            </div>

                            <div class="form-group text-white" style="margin-top: 1rem;">
                                <label for="no_ktp">No. KTP :</label>
                                <input type="text" id="no_ktp" value="{{ $user->no_ktp }}" name="no_ktp" class="form-control text-white bg-dark text-start" required>
                                <small class="form-text text-muted">Harus 16 digit.</small>
                            </div>

                            <div class="form-group text-white">
                                <label for="phone">No. Telepon :</label>
                                <input type="tel" id="phone" value="{{ $user->no_telepon }}" name="no_telepon" class="form-control text-white bg-dark text-start" pattern="\d{10,15}" required>
                                <small class="form-text text-muted">Harus antara 10-15 digit.</small>
                            </div>

                            <div class="form-group text-white" style="margin-bottom: 3rem;">
                                <label for="email">Email :</label>
                                <input type="email" id="email" value="{{ $user->email }}" name="email" class="form-control text-white bg-dark text-start" required>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-outline-warning mx-auto d-block w-100" id="pay-button">BAYAR SEKARANG</button>
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
                </div>

                <div class="card mt-3">
                    <div class="card shadow">
                        <div class="card-body border rounded bg-dark">
                            <h3 class="text-white"><i class="fa-solid fa-ticket text-white"></i> Informasi Tiket</h3>
                            <div class="row">
                                <div class="card-img">
                                    <img src="{{ asset($event->cover_event) }}" alt="poster-{{ $event->nama_event }}" style="width: 100%; border-radius:12px;">
                                </div>
                                <div class="col-6 text-white">
                                    <p>
                                        <b style="font-family: Arial, Helvetica, sans-serif; font-size:0.9rem">
                                            Tanggal Event: {{ $event->tanggal_event }}<br>
                                            Jam: {{ $event->waktu_event }}<br>
                                            Lokasi: {{ $event->lokasi_event }}
                                        </b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card shadow">
                    <div class="card-body border rounded bg-dark">
                        <h3 class="text-white"><i class="fa-solid fa-cart-shopping"></i> Rincian Pembelian</h3>
                        <div class="card-img-top rounded">
                        <h6 class="card-title text-white mt-3">{{ $event->nama_event }}</h6>
                        <hr>
                        <h6 class="card-text text-white mt-3">{{ $tiket->kategori_tiket }} | {{ $tiket_dibeli }}x</h6>
                        <h6 class="card-text text-white">Harga Tiket : <span>Rp. {{ $tiket->formatted_harga }}</span></h6>
                        <hr>
                        <h6 class="card-text text-white">Subtotal : Rp. {{ $formatted_total_harga }}</h6>
            </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
          // Also, use the embedId that you defined in the div above, here.
          window.snap.embed('$snapToken', {
            embedId: 'snap-container',
            onSuccess: function (result) {
              /* You may add your own implementation here */
              alert("payment success!"); console.log(result);
            },
            onPending: function (result) {
              /* You may add your own implementation here */
              alert("wating your payment!"); console.log(result);
            },
            onError: function (result) {
              /* You may add your own implementation here */
              alert("payment failed!"); console.log(result);
            },
            onClose: function () {
              /* You may add your own implementation here */
              alert('you closed the popup without finishing the payment');
            }
          });
        });
      </script>
</body>
                                                                                </html>
