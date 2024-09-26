<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Home Customer</title>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Carousel</title>
</head>
<body>

  <div class="carousel">
    <div class="carousel-images">
        <img src="{{ asset('components/asset/logo/s3.jpeg') }}" alt="Slide 1" class="card-img-top " style="width: 100px" >
        <img src="{{ asset('components/asset/logo/s2.jpeg') }}" alt="Slide 2" class="card-img-top" style="width: 100px">
        <img src="{{ asset('components/asset/logo/s4.jpeg') }}" alt="Slide 3" class="card-img-top"  style="width: 100px">
    </div>
    <button class="prev" onclick="prevSlide()">Previous</button>
    <button class="next" onclick="nextSlide()">Next</button>
  </div>

  <script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-images img');

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.style.display = i === index ? 'block' : 'none';
      });
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
    }

    // Menampilkan slide pertama
    showSlide(currentSlide);
  </script>

</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
