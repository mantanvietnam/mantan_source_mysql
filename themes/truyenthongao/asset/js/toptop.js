$('.slick-center-mode').slick({
    centerMode: true,
    slidesToShow: 3,
    arrows: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    dots: true,
    infinite: true, // Sửa từ "Infinity" thành "infinite"
    
    responsive: [
        {
            breakpoint: 1024, // Màn hình laptop
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 768, // Màn hình tablet
            settings: {
                slidesToShow: 1,
            }
        },
        {
            breakpoint: 576, // Màn hình mobile
            settings: {
                slidesToShow: 1,
            }
        }
    ]
});



document.addEventListener('DOMContentLoaded', function() {
    const newsList = document.querySelector('.news__list');
    const prevButton = document.querySelector('.news__nav--prev');
    const nextButton = document.querySelector('.news__nav--next');
    const newsItems = document.querySelectorAll('.news__item');

    let currentIndex = 0;
    const itemWidth = newsItems[0].offsetWidth + 30; // Include gap
    const maxIndex = newsItems.length - 3; // Show 3 items at once

    function updateCarousel() {
        newsList.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
    }

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentIndex < maxIndex) {
            currentIndex++;
            updateCarousel();
        }
    });

    // Optional: Auto slide
    let autoSlide = setInterval(() => {
        if (currentIndex < maxIndex) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateCarousel();
    }, 5000);

    // Pause auto slide on hover
    newsList.addEventListener('mouseenter', () => {
        clearInterval(autoSlide);
    });

    newsList.addEventListener('mouseleave', () => {
        autoSlide = setInterval(() => {
            if (currentIndex < maxIndex) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateCarousel();
        }, 5000);
    });
});

$(document).ready(function(){
    $('.customer-slider').slick({
        slidesToShow: 4,         // Số lượng ảnh hiển thị mỗi lần
        slidesToScroll: 1,       // Số ảnh di chuyển mỗi lần
        autoplay: true,          // Tự động trượt
        autoplaySpeed: 3000,     // Thời gian giữa mỗi lần trượt (3000ms = 3 giây)
        infinite: true,          // Lặp lại slider
        arrows: false,           // Ẩn mũi tên điều khiển
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
});