var swiper = new Swiper('.swiper-container', {
    slidesPerView: 3,        // Mặc định hiển thị 3 thẻ
    spaceBetween: 10,        // Khoảng cách giữa các thẻ
    loop: true,              // Cho phép lặp lại khi hết các thẻ
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true
    },
    breakpoints: {
        // Màn hình Mobile (dưới 768px)
        0: {
            slidesPerView: 1,
            spaceBetween: 5
        },
        // Màn hình Tablet (768px - 1023px)
        768: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        // Màn hình Desktop (1024px trở lên)
        1023: {
            slidesPerView: 3,
            spaceBetween: 10
        }
    }
});

  

$(document).ready(function() {
    // Initialize Slick Slider
    $('.month-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: $('.prev-button'),
        nextArrow: $('.next-button'),
        infinite: true
    });

    // Show event content based on selected month
    $('.month-item').on('click', function() {
        const selectedMonth = $(this).data('month');

        // Ẩn tất cả sự kiện và chỉ hiện sự kiện tương ứng
        $('.event-details').removeClass('active').hide();
        $(`.event-details[data-month="${selectedMonth}"]`).addClass('active').fadeIn();

        // Highlight current month
        $('.month-item').removeClass('slick-current');
        $(this).addClass('slick-current');
    });

    // Kích hoạt sự kiện tháng đầu tiên khi load trang
    $('.month-item').first().trigger('click');
});


$(document).ready(function () {
    $('.slidera').slick({
        slidesToShow: 3,         // Mặc định hiển thị 3 slides
        slidesToScroll: 1,       // Di chuyển 1 slide mỗi lần
        arrows: true,            // Hiển thị nút điều hướng
        prevArrow: '<button type="button" class="slick-prev">&larr;</button>',
        nextArrow: '<button type="button" class="slick-next">&rarr;</button>',
        responsive: [
            {
                breakpoint: 768, // Tablet
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480, // Mobile
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
});

function loadEvent(e) {
  var month = $(e).attr('data-month');
  console.log(month);
  //var url = 'su_kien?month='+month;
  $.ajax({
      type: "GET",
      url: '/apis/ajax_event',
      data:{ month:month }
    }).done(function( msg ) {
        console.log(msg);
      /*var msg = JSON.parse(msg);
      console.log(msg);*/
      $('.in-box-event-home').html(msg.text);
    });
     eventhome();
    
}

function removeIframe()
{
    $('#iframeCover').remove();
    $('#heroOverlay').remove();
}

document.getElementById("view360Btn").addEventListener("click", function (e) {
    e.preventDefault(); // Ngăn chặn hành động mặc định của nút nếu là liên kết
    const iframeCover = document.getElementById("iframeCover");
    const heroOverlay = document.getElementById("heroOverlay");

    // Ẩn lớp phủ
    iframeCover.style.display = "none";
    heroOverlay.style.display = "none";
});
