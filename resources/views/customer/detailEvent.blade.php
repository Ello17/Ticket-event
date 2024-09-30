{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-6.5.2-web/css/all.min.css') }}">
    <title>{{ $event->nama_event }}</title>
</head>
<body >

    @include('template.nav')

    <div class="container mt-5 mx-auto mb-4">
    <h2 class="text-center text-white mb-4">{{ $event->nama_event }}</h2>
    <hr>

    <div class="row">
        <div class="col-lg-9 mb-4 mt-2">
            <div class="card border-0 shadow-lg">
                <img src="{{ asset($event->cover_event) }}" alt="poster-{{ $event->nama_event }}" class="card-img-top rounded">
            </div>
        </div>


        <div class="col-lg-3 mb-4 mt-2">
            <div class="border rounded p-3 shadow-lg bg-dark">
                <div class="card-body">
                    <h5 class="card-title text-white" style="margin-bottom: -20px;">Tanggal</h5>
                    <p class="card-text text-white"><i class="fa-solid fa-calendar-days"></i> {{ $event->tanggal_event }}</p>
                    <h5 class="card-title text-white" style="margin-bottom: -20px;">Waktu</h5>
                    <p class="card-text text-white"><i class="fa-solid fa-clock"></i> {{ $event->waktu_event }}</p>
                    <h5 class="card-title text-white" style="margin-bottom: -20px;">Lokasi</h5>
                    <p class="card-text text-white"><i class="fa-solid fa-location-dot"></i> {{ $event->lokasi_event }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-9">
            <div class="mb-4">
                <h3 class="mb-3 text-white">Deskripsi Event</h3>
                <p class="text-white" style="font-family: Arial, Helvetica, sans-serif; font-size :0.8rem">{{ $event->deskripsi_event }}</p>
            </div>

            {{-- <h3 class="mb-4 text-white">Tiket</h3>
            @foreach($tikets as $tiket)
            <form action="{{ route('transaksi', $tiket->id) }}" method="GET">
                <div class="border rounded p-3 mb-3 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h6 class="mb-1 text-white">Ketersediaan Tiket : {{ $tiket->availability_text }}</h6>
                            <h5 class="mb-1 text-white">{{ $tiket->kategori_tiket }}</h5>
                            <p class="mb-0 text-white"><strong>Harga :  </strong>  <span>{{ $tiket->harga }}</span></p>
                        </div>
                            <div class="row">
                                <div class="col-12" style="margin-left: 30rem; margin-top:35px">
                                    <input type="number" class="form-control" name="jumlah_tiket" min="1" max="{{ $tiket->jumlah_tiket - $tiket->transaksi()->sum('jumlah_tiket') }}" placeholder="Masukkan jumlah tiket" style="width: 200px;">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <h5 class="mb-2 text-white">{{ $tiket->status }}</h5>
                                    <button type="submit" class="btn btn-warning w-100">Beli Tiket</button>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @endforeach --}}
        {{-- </div>
    </div>
</div>
<script src="{{asset('components/js/nav.js')}}"></script>
</body>
</html> --}} 
