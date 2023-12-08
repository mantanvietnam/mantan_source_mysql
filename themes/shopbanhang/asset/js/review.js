$('.slide-slick').slick({
    centerMode: true,
    centerPadding: '0',
    slidesToShow: 5,
    infinite: true,
    autoplay: false,
    autoplaySpeed: 200,
    slidesToScroll: 1,
    arrows: true,
    speed: 1000,
    prevArrow: "<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>",
    responsive: [{
            breakpoint: 769,
            settings: {
                arrows: true,
                centerMode: true,
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: true,
                centerMode: false,
                slidesToShow: 1
            }
        }
    ]

});


function openVideoModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "block";
}

function closeVideoModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.style.display = "none";
}

/* Slick san pham */
$('.list-product-review').slick({
    infinite: true,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: true,
    slidesToScroll: 5,
    speed: 1500,
    slidesToShow: 5,
    prevArrow: "<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>",
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 5,
                infinite: true
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 320,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }
    ]
});