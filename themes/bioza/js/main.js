/* THANH % */
$(".progress-bar span").each(function() {
    $(this).animate({
            width: $(this).attr("data-progress") + "%",
        },
        2500
    );
    $(this).text($(this).attr("data-progress"));
});
$(".progress-bar p").each(function() {
    $(this).animate({
            width: $(this).attr("data-progress") + "%",
        },
        2500
    );
    $(this).text($(this).attr("data-progress") + "%");
});


/* SLICK BRANd */
$(document).ready(function() {
    $('.brand-slide').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        responsive: [{
                breakpoint: 769,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});

/* COUNTER */
function animateNumber(finalNumber, delay, startNumber = 0, callback) {
    let currentNumber = startNumber
    const interval = window.setInterval(updateNumber, delay)

    function updateNumber() {
        if (currentNumber >= finalNumber) {
            clearInterval(interval)
        } else {
            currentNumber++
            callback(currentNumber)
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    animateNumber(3, 1, 0, function(number) {
        const formattedNumber = number.toLocaleString()
        document.getElementById('counter-1').innerText = formattedNumber
    })

    animateNumber(98, 1, 0, function(number) {
        const formattedNumber = number.toLocaleString()
        document.getElementById('counter-2').innerText = formattedNumber
    })

    animateNumber(13, 1, 0, function(number) {
        const formattedNumber = number.toLocaleString()
        document.getElementById('counter-3').innerText = formattedNumber
    })

    animateNumber(10, 1, 0, function(number) {
        const formattedNumber = number.toLocaleString()
        document.getElementById('counter-4').innerText = formattedNumber
    })

})

/* SLICK TESTIMONIAL */

$(document).ready(function() {
    $('.testimonial-slide').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        arrows: true,
        prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-arrow-left"></i></button>`,
        nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-arrow-right"></i></button>`,
        speed: 150
    });

});

/* OPEN MODAL VIDEO */
var openModalButton = document.getElementById("openModalVideo");
var modal = document.getElementById("modal-video");
var youtubeIframe = document.getElementById("youtubeIframe");

openModalButton.onclick = function() {
    modal.style.display = "block";
}
modal.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}


/* SCROLL SCREEN - FIXRD HEADER */
var scrollPage = document.getElementById("menu-top");

var hideBtn = document.getElementById("scroll-top");


window.onscroll = function() {
    if (window.pageYOffset > 120 || document.documentElement.scrollTop > 120) {
        scrollPage.style.position = "fixed";
        scrollPage.style.backgroundColor = "#fff";
        scrollPage.style.padding = "0 50px";
        hideBtn.style.display = "block";

    } else {
        scrollPage.style.position = "relative";
        scrollPage.style.backgroundColor = "transparent";
        scrollPage.style.padding = "0 360px";
        hideBtn.style.display = "none";

    }
}

/* SLICK  related-images */

$('.list-images').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    centerMode: true,
    prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                arrows: true,
                centerMode: false,
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 3000,
            }
        }
    ],
});

document.addEventListener("DOMContentLoaded", function() {
    var scrollToTopBtn = document.getElementById("scroll-top-btn");

    // Thêm sự kiện click vào nút
    scrollToTopBtn.addEventListener("click", function() {
        // Cuộn lên đầu trang
        window.scrollTo({
            top: 0,
            behavior: "smooth" // Tạo hiệu ứng cuộn mượt (nếu trình duyệt hỗ trợ)
        });
    });
});