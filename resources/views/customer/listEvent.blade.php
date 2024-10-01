<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-6.5.2-web/css/all.min.css') }}">
    <title>List Events</title>
    <style>
        @font-face {
            font-family: 'coolvetica rg';
            src : url('/fonts/coolvetica rg.otf') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        * {
            font-family: 'coolvetica rg', sans-serif;
            font-size: 0.95rem;
        }

        .card {
            border: none;
            background-color: #f6f6f6;
            margin-bottom: 20px;
        }

        .card-img-top {
            border-radius: 10px;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 10px;
        }

        .card-title {
            font-size: 1.2rem;
        }

        .card-text {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center text-white mb-4">Daftar Event</h2>
    <hr>

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <img src="{{ asset($event->cover_event) }}" alt="Poster {{ $event->nama_event }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->nama_event }}</h5>
                        <p class="card-text">
                            <i class="fa-solid fa-calendar-days"></i> {{ $event->tanggal_event }}<br>
                            <i class="fa-solid fa-clock"></i> {{ $event->waktu_event }}<br>
                            <i class="fa-solid fa-location-dot"></i> {{ $event->lokasi_event }}
                        </p>
                        <a href="{{ route('detailEvent', $event->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="{{ asset('components/js/nav.js') }}"></script>
</body>
</html>
