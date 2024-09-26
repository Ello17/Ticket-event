<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Customer</title>
</head>
<body>
    <div class="carousel">
        <!-- Input untuk mengontrol slide -->
        <input type="radio" name="carousel" id="slide1" checked>
        <input type="radio" name="carousel" id="slide2">
        <input type="radio" name="carousel" id="slide3">

        <!-- Gambar Slide -->
        <div class="carousel-images">
          <div>
            <img src="{{ components('') }}" alt="Slide 1">
          </div>
          <div>
            <img src="s3.jepg" alt="Slide 2">
          </div>
          <div>
            <img src="s4.jepg" alt="Slide 3">
          </div>
        </div>

        <!-- Navigasi dengan label -->
        <div class="navigation">
          <label for="slide1">Slide 1</label>
          <label for="slide2">Slide 2</label>
          <label for="slide3">Slide 3</label>
        </div>
      </div>

</body>
</html>
