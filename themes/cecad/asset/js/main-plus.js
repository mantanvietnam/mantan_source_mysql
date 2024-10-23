// Hàm kiểm tra xem phần tử có nằm trong khung nhìn không
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}



// Lắng nghe sự kiện cuộn trang
document.addEventListener("scroll", function onScroll() {
    const countSection = document.getElementById("count-section");

    // Kiểm tra nếu phần tử count-section đã xuất hiện trong khung nhìn
    if (isInViewport(countSection)) {
        // Lặp qua tất cả các phần tử .counter có class count-start và kích hoạt bộ đếm
        document.querySelectorAll(".counter_item.count-start").forEach((item) => {
            let count = 0;
            let counterElement = item.querySelector(".counter");

            // Lấy giá trị mục tiêu và giá trị increment từ thuộc tính data
            let targetNumber = parseInt(counterElement.dataset.number);
            let increment = parseInt(counterElement.dataset.increment) || 10; // Mặc định là 10 nếu không có giá trị
            let duration = 6000; // Thời gian chạy bộ đếm trong mili giây
            let totalFrames = Math.round(duration / 16); // Tổng số frame trong khoảng thời gian
            let currentFrame = 0;

            function animateCounter() {
                currentFrame++;
                count += increment;
                counterElement.innerHTML = Math.min(count, targetNumber);

                // Dừng đếm khi đạt tới giá trị mục tiêu
                if (count < targetNumber && currentFrame < totalFrames) {
                    requestAnimationFrame(animateCounter);
                }
            }

            // Bắt đầu hoạt động bộ đếm
            requestAnimationFrame(animateCounter);

            // Loại bỏ class count-start để không kích hoạt lại bộ đếm khi cuộn lại
            item.classList.remove("count-start");
        });

        // Sau khi kích hoạt bộ đếm, không cần theo dõi nữa
        document.removeEventListener("scroll", onScroll);
    }
});


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

$('.as4-block-1').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    responsive: [{
            breakpoint: 1050,
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


document.addEventListener("DOMContentLoaded", () => {
    document.body.classList.add('loaded');
});