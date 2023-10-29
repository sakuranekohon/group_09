var slideshow = document.getElementById('slideshow');
var dots2 = document.getElementById('dots');
function createAD() {
    axios.get("./backend/adselect.php?ac=getAD")
        .then((response) => {
            var data = response.data.data;
            for (let i = 0; i < data.length; i++) {
                var newshow = document.createElement('img');
                var dot = document.createElement('div');

                if (i === data.length - 1) {
                    newshow.setAttribute("class", "active");
                    newshow.setAttribute("src", "./backend/ADimages/" + data[i].name);
                    slideshow.prepend(newshow);
                    dot.setAttribute("class", "dot active");
                    dots2.prepend(dot);
                } else {
                    newshow.setAttribute("src", "./backend/ADimages/" + data[i].name);
                    slideshow.prepend(newshow);
                    dot.setAttribute("class", "dot");
                    dots2.prepend(dot);
                }
            }
        })
        .catch((error) => {
            console.error(error);
        });
}
createAD();


document.addEventListener("DOMContentLoaded", () => {
    var slideIndex = 0;
    // var images=document.querySelectorAll('.slideshow img');
    var images = document.querySelector('#slideshow').querySelectorAll('img');
    var prevArrow = document.querySelector('.prev');
    var nextArrow = document.querySelector('.next');
    var dots = document.querySelectorAll('.dot');



    function showSlides() {
        images=document.querySelector('#slideshow').querySelectorAll('img');
        dots=document.querySelectorAll('.dot');

        for(var i = 0; i<images.length; i++) {
    images[i].classList.remove('active');
    dots[i].classList.remove('active');
}

images[slideIndex].classList.add('active');
dots[slideIndex].classList.add('active');
    }

function prevSlide() {
    images = document.querySelector('#slideshow').querySelectorAll('img');
    dots = document.querySelectorAll('.dot');

    images[slideIndex].classList.remove('active');
    dots[slideIndex].classList.remove('active');
    slideIndex--;

    if (slideIndex < 0) {
        slideIndex = images.length - 1;
    }

    showSlides();
}

function nextSlide() {
    images = document.querySelector('#slideshow').querySelectorAll('img');
    dots = document.querySelectorAll('.dot');

    // console.log(images);
    images[slideIndex].classList.remove('active');
    dots[slideIndex].classList.remove('active');
    slideIndex++;

    if (slideIndex >= images.length) {
        slideIndex = 0;
    }

    showSlides();
}

prevArrow.addEventListener('click', prevSlide);
nextArrow.addEventListener('click', nextSlide);

for (var i = 0; i < dots.length; i++) {
    images = document.querySelector('#slideshow').querySelectorAll('img');
    dots = document.querySelectorAll('.dot');

    dots[i].addEventListener('click', function () {
        var dotIndex = Array.prototype.indexOf.call(dots, this);
        images[slideIndex].classList.remove('active');
        dots[slideIndex].classList.remove('active');
        slideIndex = dotIndex;
        showSlides();
    });
}

setInterval(function () {
    nextSlide();
}

    , 5000);
});
