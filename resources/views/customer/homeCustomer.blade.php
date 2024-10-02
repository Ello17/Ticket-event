@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{asset('components/css/homeCustomer.css')}}">
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
@endpush
    @section('title', 'Tiket Mudah hanya di Tiket Mudah')
    @section('content')

     <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{asset('components/asset/b1.jpeg')}}" class="d-block w-70" alt="Slide 1">
          </div>
          <div class="carousel-item">
            <img src="{{asset('components/asset/b2.jpeg')}}" class="d-block w-70" alt="Slide 2">
          </div>
          <div class="carousel-item">
            <img src="{{asset('components/asset/b3.jpeg')}}" class="d-block w-70" alt="Slide 3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>

                <!-- Slider 2 -->
                <div class="carousel mb-4" id="carousel2">
                    <div class="carousel-images d-flex justify-content-center">
                        <img src="{{ asset('components/asset/b4.jpeg') }}" alt="Slide 1" class="img-fluid" style="max-width: 400px;">
                        <img src="{{ asset('components/asset/b5.jpeg') }}" alt="Slide 2" class="img-fluid" style="max-width: 400px;">
                        <img src="{{ asset('components/asset/b1.jpeg') }}" alt="Slide 3" class="img-fluid" style="max-width: 400px;">
                    </div>
                    <button class="btn btn-primary mt-2" onclick="prevSlide(2)">Previous</button>
                    <button class="btn btn-primary mt-2" onclick="nextSlide(2)">Next</button>
                </div>
            </div>
        </div>

        <!-- Cards -->
        <div class="row justify-content-center">
            @foreach ($data as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card shadow-lg">
                    <img src="{{ asset($item->cover_event) }}" alt="Card Image" class="card-img-top" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-dark">{{ $item->nama_event }}</h5>
                        <p>{{ $item->tanggal_event }}</p>
                        <p>{{ $item->lokasi_event }}</p>
                        <p>{{ $item->waktu_event }}</p>
                        <a href="{{ route('detailEvent', $item->id) }}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{route('listEvent')}}">See All Event</a>
    </div>

    @endsection --}}
@push('js')
<script src="{{asset('components/js/slider.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endpush
