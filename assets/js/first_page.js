$('#courses_loop.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    dots: false,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
})

let prevArrow = document.querySelector('#courses_loop .owl-prev');

let nextArrow = document.querySelector('#courses_loop .owl-next');

prevArrow.innerHTML = "<i class=\"fa-solid fa-arrow-left\"></i>"

nextArrow.innerHTML = "<i class=\"fa-solid fa-arrow-right\"></i>"