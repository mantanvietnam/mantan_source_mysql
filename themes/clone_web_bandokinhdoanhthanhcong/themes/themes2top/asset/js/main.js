let intro = document.querySelector('.intro');
let logo = document.querySelector('.logo-header');
let logoSpan = document.querySelectorAll('.logo');

window.addEventListener('DOMContentLoaded', () => {

    setTimeout(() => {

        logoSpan.forEach((span, idx) => {
            setTimeout(() => {
                span.classList.add('active');
            }, (idx + 1) * 400)
        });

        setTimeout(() => {
            logoSpan.forEach((span, idx) => {


                setTimeout(() => {
                    span.classList.remove('active');
                    span.classList.add('fade');
                }, (idx + 1) * 50)
            })

        }, 2000);

        setTimeout(() => {
            intro.style.top = '-100vh';
        }, 1500)

    })

})

/*  BANNER SLICK  */

$('.banner-sub').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.banner-img',

});
// Khởi tạo Slick Carousel cho phần banner-img
$('.banner-img').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.banner-sub',
    dots: true,
    dotsClass: 'slick-dots',
    customPaging: function(slider, i) {
        return '<i class="fa-solid fa-circle"></i>';
    },
    arrows: false,
    fade: true,
    centerMode: true,
    focusOnSelect: true,
    speed: 1000
});


/*   FORM TƯ VẤN   */
$(document).ready(function() {
    $('.advise-button').click(function() {
        $('#popupOverlay').fadeIn();
        $('body').addClass('overlay-hidden'); // Thêm lớp CSS khi hiển thị overlay
    });

    $('#closeButton').click(function() {
        $('#popupOverlay').fadeOut();
        $('body').removeClass('overlay-hidden'); // Loại bỏ lớp CSS khi đóng overlay
    });

    $(document).mouseup(function(e) {
        var popup = $('.popup');
        if (!popup.is(e.target) && popup.has(e.target).length === 0) {
            $('#popupOverlay').fadeOut();
            $('body').removeClass('overlay-hidden'); // Loại bỏ lớp CSS khi click ngoài overlay
        }
    });
});


/*   SLICK LOGO ĐỐI TÁC   */
$('.list-partner').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    rows: 3,
    infinite: true,
    speed: 300,
    touchMove: true,
    swipeToSlide: true,
    fps: 60,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left fa-beat"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right fa-beat"></i></button>`,
    responsive: [{
            breakpoint: 1025,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 3,

            }
        },
        {
            breakpoint: 501,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }
    ]
});

/*    HEADER FIXED    */
var scrollPage = document.getElementById("menu");

window.onscroll = function() {
    if (window.pageYOffset > 120 || document.documentElement.scrollTop > 120) {
        scrollPage.style.position = "fixed";
        scrollPage.style.transition = "all 0.3s ease-in-out";


    } else {
        scrollPage.style.position = "relative";
        scrollPage.style.transition = "all 0.3s ease-in-out";

    }
}



/*   FEEDBACK   */

$('.fb-slide-1').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: '.fb-slide-2, .fb-slide-3',
});

$('.fb-slide-2').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    asNavFor: '.fb-slide-1, .fb-slide-3',
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-arrow-left-long"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-arrow-right-long"></i></button>`,
    dots: true,
    dotsClass: 'slick-dots',
    customPaging: function(slider, i) {
        return '<i class="fa-solid fa-circle"></i>';
    },


});

$('.fb-slide-3').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: '.fb-slide-2, .fb-slide-1',
});



/*     SLIDE TIN TỨC     */
$('.slide-news').slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows: false,
    dots: true,
    dotsClass: 'slick-dots',
    customPaging: function(slider, i) {
        return '<i class="fa-solid fa-circle"></i>';
    },
    responsive: [{
            breakpoint: 1025,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 769,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 501,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]

});


/*     SLIDE dịch vụ trang chi tiết bài viết     */
$('.pg-slide-services').slick({
    infinite: true,
    speed: 500,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-caret-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-caret-right"></i></button>`,

});



// Swiper trang tuyen dung
var swiper = new Swiper(".swiper", {
    grabCursor: true,
    speed: 400,
    mousewheel: {
        invert: true,
    },
    scrollbar: {
        el: ".swiper-scrollbar",
        draggable: true,
    },
    slidesPerView: 1.75,
    spaceBetween: 20,
    breakpoints: {
        501: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
        1024: {
            slidesPerView: 1.3,
            spaceBetween: 15,
        },
    },
});


// Fancybox album anh trang tuyen dung
$('[data-fancybox="gallery"]').fancybox({
    buttons: [
        "slideShow",
        "thumbs",
        "zoom",
        "fullScreen",
        "share",
        "close"
    ],
    loop: false,
    protect: true
});



// Swiper nhân sự trang chủ


const mySwiper = new Swiper('.swiper-container', {
    effect: 'coverflow',
    slidesPerView: 'auto',
    centeredSlides: true,
    coverflowEffect: {
        slideShadows: true,
        rotate: 20,
        stretch: 0,
        depth: 350,
        modifier: 1,
    },
    // mousewheel: {
    //     invert: true,
    // },

});

/* Tắt hiệu ứng AOS khi đạt đến kích thước màn hình 768px */
