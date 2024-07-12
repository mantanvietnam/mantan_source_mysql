$('.partner-list').slick({
    centerMode: true,
    slidesToShow: 5,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: false,
    responsive: [{
            breakpoint: 850,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 2
            }
        }
    ]
});

$('.home-news-list').slick({
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: false,
    dots: true,
    dotsClass: 'slick-dots',
    customPaging: function(slider, i) {
        return '<i class="fa-solid fa-circle"></i>';
    },
    responsive: [{
            breakpoint: 850,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 1
            }
        }
    ]
});

$('.slide-albums-content').slick({
    dots: true,
    arrows: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true
});


$('.list-slide-detail-albums').slick({
    arrows: false,
    infinite: true,
    slidesToShow: 1,
    dots: true,
});

let counter = document.querySelectorAll(".counter")
let arr = Array.from(counter)

arr.map((item) => {
    let count = 0

    function CounterUp() {
        count++
        item.innerHTML = count
        if (count == item.dataset.number) {
            clearInterval(stop);
        }
    }
    let stop = setInterval(
        function() {
            CounterUp();
        }, 10 / item.dataset.speed
    );
})


$('.latest-news-list').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2500,
    dots: true,
    dotsClass: 'slick-dots',
    customPaging: function(slider, i) {
        return '<i class="fa-solid fa-circle"></i>';
    },

    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 850,
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





$('[data-fancybox]').fancybox({
    buttons: [
        'close'
    ],
    wheel: false,
    transitionEffect: "slide",
    loop: true,
    toolbar: false,
    clickContent: false
});