$(document).ready(function () {
    const urlPrev = "/themes/training/assets/img/prev.svg";
    const urlNext = "/themes/training/assets/img/next.svg";

    $('.my-slider-more-courses').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: `<button class="slider-nav slider-prev-arr d-none d-lg-block"><img src='${urlPrev}' /></button>`,
        nextArrow: `<button class="slider-nav slider-next-arr d-none d-lg-block"><img src='${urlNext}' /></button>`,


        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
});