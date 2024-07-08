let swiper = new Swiper('.swiper', {
    loop: true,
    watchSlidesProgress: true,
    autoplay: {
        speed: 1500
    },
    pagination: {
        el: '.swiper-pagination',
    },
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    on: {
        slideChangeTransitionEnd: function(s) {
            i = s.progress;
            params = s.params;
            console.log("progress" + i);
            if (i >= 1) {
                swiper.destroy(false, false);
                params.autoplay = false;
                swiper = new Swiper('.swiper', params);
            }
        }
    }
});

var swiper1 = new Swiper('.swiper1', {
    cssMode: true,
    slidesPerView: 1.15,
    spaceBetween: 0,
    breakpoints: {
        1050: {
            slidesPerView: 2,
            spaceBetween: 15,
        },
        801: {
            slidesPerView: 1,
            spaceBetween: 15,
        },
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
    },
    mousewheel: true,
    keyboard: true,
});

// Hàm cập nhật Swiper
function updateSwiper() {
    var width = window.innerWidth;
    if (width > 850) {
        swiper1.params.slidesPerView = 1.15; // Ví dụ: cập nhật số slide hiển thị
        swiper1.params.spaceBetween = 0; // Ví dụ: cập nhật khoảng cách giữa các slide
    } else {
        swiper1.params.slidesPerView = 1;
        swiper1.params.spaceBetween = 0;
    }
    swiper1.update();
}

// Gọi hàm khi tải trang
updateSwiper();

// Gọi hàm khi kích thước cửa sổ thay đổi
window.addEventListener('resize', updateSwiper);