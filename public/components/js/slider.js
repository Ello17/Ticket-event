
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
