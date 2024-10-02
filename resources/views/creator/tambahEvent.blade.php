<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Hotel</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <style>
        
        body {
            background-color:#ffffff; 
        }
        .card {
            margin: 0 auto; 
            max-width: 500px; 
            padding: 20px;
            background-color: #b9e2f4; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }
        .card-title {
            text-align: center; 
            margin-top: 0;
        }
        .form-control {
            margin-bottom: 15px; 
        }
    </style>
</head>
<body>
    
        <div class="container mt-5">
            <div class="row">
                    <div class="card">
                         <h2 class="text-center mt-3">Tambah Event</h2> 
                       <form action="{{route('postTambahEvent')}}" method="POST" class="form-group" enctype="multipart/form-data">
                        @csrf
                        <label for="nama_event">Nama Event</label>
                        <input type="text" required name="nama_event" class="form-control">
                        {{-- <label for="nama_event">Nama Penyelengg</label>
                        <input type="text" required name="nama_event" class="form-control"> --}}
                        <label for="location">Lokasi</label>
                        <input type="text" required name="location" class="form-control">
                        <label for="description">Deskripsi</label>
                        <input type="text" required name="description" class="form-control">
                        <label for="image">Gambar Hotel</label>
                        <input type="file" accept="image/*" name="image" class="form-control">
                        
                        <button class="btn btn-success mt-3" > Tambah</button>
                       
                       </form>
                    </div>

                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach 
                    </div>
                @endif
            </div>
        </div>
       
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>