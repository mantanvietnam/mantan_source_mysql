// Slick Destinations
$('.destinations-slide').slick({
    centerMode: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3500,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-arrow-left-long"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-arrow-right-long"></i></button>`,
    infinite: true,
    responsive: [{
            breakpoint: 769,
            settings: {
                arrows: true,
                centerMode: false,
                slidesToShow: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: false,
                slidesToShow: 1
            }
        }
    ]
});


// Hàm đóng navbar
function closeNavbar() {
    var navbar = document.querySelector('.navbar-collapse');
    var navbarToggler = document.querySelector('.navbar-toggler');

    // Kiểm tra nếu navbar đang mở (class 'show')
    if (navbar.classList.contains('show')) {
        navbarToggler.click(); // Đóng navbar
    }
}

// Sự kiện click: đóng navbar nếu bấm ra ngoài
document.addEventListener('click', function(event) {
    var navbar = document.querySelector('.navbar-collapse');
    var isClickInside = navbar.contains(event.target);
    var isTogglerButton = event.target.classList.contains('navbar-toggler');

    // Kiểm tra nếu click ra ngoài navbar và nút toggle không được bấm
    if (!isClickInside && !isTogglerButton) {
        closeNavbar(); // Đóng navbar
    }
});

// Sự kiện scroll: đóng navbar nếu cuộn xuống hơn 100px
window.addEventListener('scroll', function() {
    if (window.scrollY > 100) {
        closeNavbar(); // Đóng navbar
    }
});


const fixedElement = document.getElementById('fixedNav');
window.addEventListener('scroll', () => {
    const screenWidth = window.innerWidth;

    // Chỉ áp dụng khi chiều rộng màn hình ngoài khoảng 500px - 950px
    if (screenWidth < 500 || screenWidth > 950) {
        if (window.scrollY > 90) {
            fixedElement.style.position = 'fixed';
        } else {
            fixedElement.style.position = 'relative';
        }
    } else {
        // Đảm bảo khi vào khoảng 500px - 950px thì luôn đặt lại vị trí ban đầu
        fixedElement.style.position = 'relative';
    }
});


//Slick Places
$('.places-slide').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    autoplay: false,
    autoplaySpeed: 3500,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-arrow-left-long"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-arrow-right-long"></i></button>`,
    responsive: [{
        breakpoint: 480,
        settings: {
            dots: false,
        }
    }, ]
});

//Slick Events
$('.events-month-slide').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    centerMode: true,
    asNavFor: '.events-slide',
    prevArrow: `<button type='button' class='slick-arrow slick-prev mon-pull-left'><i class="fa-solid fa-arrow-left-long"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next mon-pull-right'><i class="fa-solid fa-arrow-right-long"></i></button>`,
    responsive: [{
        breakpoint: 480,
        settings: {
            arrows: false,
        }
    }, ]
});

$('.events-slide').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.events-month-slide',
    centerMode: false,
    focusOnSelect: true,
    arrows: false,
});

//Slick Relics Detail Image 
$('.slide-relics-image').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3500,
    infinite: true,
    arrows: false
});

//Slick ĐỊA ĐIỂM XUNG QUANH
$('.relics-destinations-slide').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3500,
    infinite: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-arrow-left-long"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-arrow-right-long"></i></button>`,
    arrows: true,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 769,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                slidesToShow: 1
            }
        }
    ]
});

// SLICK CHI TIẾT TIN TỨC - SỰ KIỆN

$('.slick-news').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3500,
    infinite: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    arrows: true,
    responsive: [{
            breakpoint: 769,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                slidesToShow: 1
            }
        }
    ]
});

$('.slide-artifacts').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    autoplay: false,
    autoplaySpeed: 3500,
    infinite: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    arrows: true,
    responsive: [{
            breakpoint: 1025,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
        },
        {
            breakpoint: 769,
            settings: {
                arrows: true,
                slidesToScroll: 2,
                slidesToShow: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }
    ]
});

$('.artifacts-slide-1').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.artifacts-slide-2',
    arrows: false,
    infinite: true,
    verticalSwiping: true,
    vertical: true,
    focusOnSelect: true,
    responsive: [{
        breakpoint: 480,
        settings: {
            arrows: false,
            vertical: false,
            verticalSwiping: false,
            centerMode: true,

        }
    }, ]
});

$('.artifacts-slide-2').slick({
    slidesToShow: 1,
    infinite: true,
    slidesToScroll: 1,
    asNavFor: '.artifacts-slide-1',
    arrows: false,
    fade: true,
});


$('.slide-artifacts-other').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    autoplay: false,
    autoplaySpeed: 3500,
    infinite: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    arrows: true,
    responsive: [{
            breakpoint: 1025,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
        },
        {
            breakpoint: 769,
            settings: {
                arrows: true,
                slidesToScroll: 2,
                slidesToShow: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }
    ]
});


// $(document).ready(function () {
//     $(".rotate").click(function () {
//         $(this).toggleClass("right");
//         $('.box-menu-map').slideToggle();
//         console.log('a')
//     })
//   });