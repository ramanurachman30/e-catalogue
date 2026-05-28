
// source code untuk navbar ketika scroll
let lastScroll = 0;
const navbar = document.getElementsByClassName("navbar")[0];

window.addEventListener("scroll", function () {
  let currentScroll = window.pageYOffset;

  if (currentScroll > lastScroll) {
    // scroll ke bawah → sembunyikan
    navbar.style.top = "-56px";
  } else {
    // scroll ke atas → tampilkan
    navbar.style.top = "0";
  }

  lastScroll = currentScroll;
});


// source code image geser

document.addEventListener("DOMContentLoaded", function(){
  const slides = document.querySelector("#carouselExampleDark")

  const carousel = new bootstrap.Carousel(slides,{
    interval: 3000,
    ride: "carousel",
    pause: false
  })
})



//source code untuk elemen button onclick
const btnGallery = document.querySelector(".btn").addEventListener("click", function(){
  window.location = "gallery.html"
})

