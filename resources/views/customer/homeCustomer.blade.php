<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Home Customer</title>
</head>
<body>

<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Slider 1 -->
            <div class="carousel mb-4" id="carousel1">
                <div class="carousel-images d-flex justify-content-center">
                    <img src="{{ asset('components/asset/b1.jpeg') }}" alt="Slide 1" class="img-fluid" style="max-width: 400px;">
                    <img src="{{ asset('components/asset/b2.jpeg') }}" alt="Slide 2" class="img-fluid" style="max-width: 400px;">
                    <img src="{{ asset('components/asset/b3.jpeg') }}" alt="Slide 3" class="img-fluid" style="max-width: 400px;">
                </div>
                <button class="btn btn-primary mt-2" onclick="prevSlide(1)">Previous</button>
                <button class="btn btn-primary mt-2" onclick="nextSlide(1)">Next</button>
            </div>

            <!-- Slider 2 -->
            <div class="carousel mb-4" id="carousel2">
                <div class="carousel-images d-flex justify-content-center">
                    <img src="{{ asset('components/asset/b4.jpeg') }}" alt="Slide 1" class="img-fluid" style="max-width: 400px;">
                    <img src="{{ asset('components/asset/b5.jpeg') }}" alt="Slide 2" class="img-fluid" style="max-width: 400px;">
                    <img src="{{ asset('components/asset/b6.jpeg') }}" alt="Slide 3" class="img-fluid" style="max-width: 400px;">
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
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    // Slider 1 and Slider 2
    let currentSlide1 = 0;
    let currentSlide2 = 0;

    const slides1 = document.querySelectorAll('#carousel1 .carousel-images img');
    const slides2 = document.querySelectorAll('#carousel2 .carousel-images img');

    function showSlide(slider, index) {
        let slides;
        if (slider === 1) {
            slides = slides1;
        } else {
            slides = slides2;
        }
        slides.forEach((slide, i) => {
            slide.style.display = i === index ? 'block' : 'none';
        });
    }

    function nextSlide(slider) {
        if (slider === 1) {
            currentSlide1 = (currentSlide1 + 1) % slides1.length;
            showSlide(1, currentSlide1);
        } else {
            currentSlide2 = (currentSlide2 + 1) % slides2.length;
            showSlide(2, currentSlide2);
        }
    }

    function prevSlide(slider) {
        if (slider === 1) {
            currentSlide1 = (currentSlide1 - 1 + slides1.length) % slides1.length;
            showSlide(1, currentSlide1);
        } else {
            currentSlide2 = (currentSlide2 - 1 + slides2.length) % slides2.length;
            showSlide(2, currentSlide2);
        }
    }

    // Initialize both sliders to show the first image
    showSlide(1, currentSlide1);
    showSlide(2, currentSlide2);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
