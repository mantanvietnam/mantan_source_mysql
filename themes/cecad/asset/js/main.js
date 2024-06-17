$('.about-block-3-slide').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
});

$('.about-block-4-slide').slick({
    slidesToShow: 3,
    slidesToScroll: 2,
    autoplay: true,
    autoplaySpeed: 2000,
    rows: 2,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
});

$('.pg-block-4-list').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 789,
            settings: {
                slidesToShow: 2,
            }
        }, {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 5000,
            }
        },
    ]
});