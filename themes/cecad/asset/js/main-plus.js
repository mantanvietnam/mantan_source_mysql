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
document.addEventListener("scroll", function() {
    const countSection = document.getElementById("count-section");

    // Kiểm tra nếu phần tử count-section đã xuất hiện trong viewport
    if (isInViewport(countSection)) {
        // Lặp qua tất cả các phần tử .counter có class count-start và kích hoạt bộ đếm
        document.querySelectorAll(".counter_item.count-start").forEach((item) => {
            let count = 0;
            let targetNumber = parseInt(item.querySelector(".counter").dataset.number);
            let duration = 3000; // Thời gian chạy bộ đếm trong mili giây (2 giây)
            let increment = 6; // Số lượng giá trị tăng mỗi lần

            function CounterUp() {
                count += increment;
                item.querySelector(".counter").innerHTML = Math.min(count, targetNumber);
                if (count >= targetNumber) {
                    clearInterval(stop);
                }
            }

            let steps = Math.ceil(duration / (100 / item.querySelector(".counter").dataset.speed)); // Số lần lặp trong thời gian cho trước

            let stop = setInterval(function() {
                CounterUp();
                steps--;
                if (steps <= 0) {
                    clearInterval(stop);
                }
            }, 100 / item.querySelector(".counter").dataset.speed);

            // Loại bỏ class count-start để không kích hoạt lại bộ đếm khi cuộn lại
            item.classList.remove("count-start");
        });

        // Sau khi kích hoạt bộ đếm, không cần theo dõi nữa
        document.removeEventListener("scroll", this);
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