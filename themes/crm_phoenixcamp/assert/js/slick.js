$('.produce-img-nav').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    asNavFor: '.produce-img-for'
});

$('.produce-img-for').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.produce-img-nav',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    arrows: false,

});

$('.blog-list').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    focusOnSelect: true,
    arrows: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    responsive: [{
            breakpoint: 780,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 350,
            settings: {
                slidesToShow: 1
            }
        },

    ]

});

$('.list-produce-other').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    focusOnSelect: true,
    arrows: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    responsive: [{
            breakpoint: 780,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 350,
            settings: {
                slidesToShow: 1
            }
        },

    ]

});