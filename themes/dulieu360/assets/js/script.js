// const foot_bar = document.getElementById('foot_bar');
// const fixedOffset = foot_bar.offsetTop;
// window.addEventListener('scroll', function() {
//     if (window.pageYOffset >= fixedOffset) {
//         foot_bar.classList.add('fixed');
//     } else {
//         foot_bar.classList.remove('fixed');
//     }
// });
//slick center mode
console.log('test');


$(document).ready(function() {
    console.log('test');
    $('.list-places').slick({
        centerMode: true,
        centerPadding: '20px',
        slidesToShow: 3,
        focusOnSelect: true,
        infinite: true,
        arrows: true,
        prevArrow: `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
        nextArrow: `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`,

        responsive: [{
                breakpoint: 769,
                settings: {
                    arrows: true,
                    centerMode: false,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    centerMode: false,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });
    console.log('a');

});



const fixedElement = document.getElementById('foot_bar');

window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
        fixedElement.style.position = 'fixed';
        fixedElement.style.backgroundColor = '#019680';
    } else {
        fixedElement.style.position = 'relative';
        fixedElement.style.backgroundColor = 'transparent';
    }
});

// Show banner 360
function hideDiv() {
    document.getElementById("hide-1").style.display = "none";
    document.getElementById("hide-2").style.display = "none";
}

// btn scroll down
$(function() {
    $('.scroll-down').click(function() {
        $('html, body').animate({ scrollTop: $('section.ok').offset().top }, 'slow');
        return false;
    });
});

// btn about
$(document).ready(function() {
    $(".infor-content").hide();
    $(".btn_about_1").show();
    $(".btn_about_2").hide();


    $(".btn_about_1").click(function() {
        $(".infor-content").css('display', 'block');
        $(".btn_about_2").css('display', 'block');
        $(".btn_about_1").css('display', 'none');
    });
    $(".btn_about_2").click(function() {
        $(".infor-content").hide();
        $(".btn_about_1").css('display', 'block');
        $(".btn_about_2").css('display', 'none');
    });
});

// btn profile
$('.btn_profile').click(function() {
    $('#pdf').show();
});
$('.close_pdf').click(function() {
    $('#pdf').hide();
});


// Event 12 month -- Nav Tab
function openEvent(eventName) {
    var i;
    var x = document.getElementsByClassName("slide-event");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(eventName).style.display = "flex";
}

function showEvent() {
    var selectElement = document.getElementById("event-selector");
    var selectedValue = selectElement.value;

    // Lấy danh sách tất cả các sự kiện
    var events = document.querySelectorAll(".slide-event");

    // Ẩn tất cả các sự kiện
    events.forEach(function(event) {
        event.style.display = "none";
    });

    // Hiển thị sự kiện được chọn
    var selectedEvent = document.getElementById(selectedValue);
    selectedEvent.style.display = "flex";
}


//show / hide lớp tìm kiếm
function showSearchModal() {
    var searchModal = document.getElementById('screen-search');
    searchModal.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Ngăn cuộn trang web phía sau
}

// Đóng lớp tìm kiếm
function closeSearchModal() {
    var searchModal = document.getElementById('screen-search');
    searchModal.style.display = 'none';
    document.body.style.overflow = 'auto'; // Cho phép cuộn trang web phía sau
}

//btn scroll top
window.addEventListener("scroll", function() {
    var scrollButton = document.getElementById("scrollTop");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        scrollButton.style.display = "block";
    } else {
        scrollButton.style.display = "none";
    }
});
document.getElementById("scrollTop").addEventListener("click", function() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});


// const colorNav = document.getElementsByClassName('navbar-nav');

// window.addEventListener('scroll', () => {
//     if (window.scrollY > 20) {
//         colorNav.style.backgroundColor = '#019680';
//     } else {
//         colorNav.style.backgroundColor = 'transparent';
//     }
// });