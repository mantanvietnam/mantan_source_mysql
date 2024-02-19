$('.video-slide').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    prevArrow: "<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>",
    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
        }
    },
    {
        breakpoint: 600,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    },
    {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    }
]
});

$('.blog-list').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    // autoplay: true,
    // autoplaySpeed: 2000,
    prevArrow: "<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>",
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]

});

$('.category-product-slide').slick({
    slidesToShow: 5,
    slidesToScroll: 5,
    // autoplay: true,
    // autoplaySpeed: 2000,
    prevArrow: "<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>",
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]

});


$('.banner-slide').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: false
});

$('.product-new-slide').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 2,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>",
    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
        }
    },
    {
        breakpoint: 600,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    },
    {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    }
]
});

