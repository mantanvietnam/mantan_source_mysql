$(document).ready(function () {
    console.log('private2');  
    $(".mm-bar").click(function () {
      $(".nav-mobile").addClass("open_menu");
    });
  
    $(".close-mm a").click(function () {
      $(".nav-mobile").removeClass("open_menu");
    });
  
    $(".head-tab a").click(function () {
      var tab_id = $(this).attr("data-tab");
  
      $(".head-tab a").removeClass("active");
      $(".content-tab").removeClass("active");
  
      $(this).addClass("active");
      $("#" + tab_id).addClass("active");
    });
  
    $(".tab-top-toturial a").click(function () {
      var tab_id = $(this).attr("data-tab");
  
      $(".tab-top-toturial a").removeClass("active");
      $(".tab-content").removeClass("active");
  
      $(this).addClass("active");
      $("#" + tab_id).addClass("active");
    });
  
    var numberSpinner = (function () {
      $(".number-spinner>.ns-btn>a").click(function () {
        var btn = $(this),
          oldValue = btn.closest(".number-spinner").find("input").val().trim(),
          newVal = 0;
  
        if (btn.attr("data-dir") === "up") {
          newVal = parseInt(oldValue) + 1;
        } else {
          if (oldValue > 1) {
            newVal = parseInt(oldValue) - 1;
          } else {
            newVal = 1;
          }
        }
        btn.closest(".number-spinner").find("input").val(newVal);
      });
      $(".number-spinner>input").keypress(function (evt) {
        evt = evt ? evt : window.event;
        var charCode = evt.which ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
        }
        return true;
      });
    })();
  
    $(".slider-nav").slick({
      arrows: true,
      slidesToShow: 6,
      slidesToScroll: 1,
      asNavFor: ".slider-for",
      dots: false,
      focusOnSelect: true,
      autoplay: true,
      autoplaySpeed: 2000,
      nextArrow:
        '<a href="javascript:void(0)" class="arr-right arr-right-nav"><img src="/themes/godraw/images/slide-right.svg" class="img-fluid" alt=""></a>',
      prevArrow:
        '<a href="javascript:void(0)" class="arr-left arr-right-nav"><img src="/themes/godraw/images/slide-left.svg" class="img-fluid" alt=""></a>',
      responsive: [
        {
          breakpoint: 1023,
          settings: {
            slidesToShow: 4,
            dots: false,
            arrows: false

          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 4,
            dots: true,
            arrows: false
          },
        },
      ],
    });
  
    $(".slider-for").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: ".slider-nav",
      nextArrow:
        '<a href="javascript:void(0)" class="arr-right"><img src="/themes/godraw/images/slide-right.svg" class="img-fluid" alt=""></a>',
      prevArrow:
        '<a href="javascript:void(0)" class="arr-left"><img src="/themes/godraw/images/slide-left.svg" class="img-fluid" alt=""></a>',
    });



  

    $(window).resize(function () {
          var screenHeight = $(window).height();
          $('main.main-cover').css('height', screenHeight + 'px');
          console.log(screenHeight);
    });

    


    $(document).ready(function() {
        $('#fullpage').fullpage({
            
            sectionSelector: '.section',
    
          anchors: ['section1', 'section2', 'section3', "section4"],
          menu: '#menu',
          scrollBar: false,
          navigation: false,
          navigationPosition: 'right',
          scrollOverflow: true,
          controlArrows: false, // Thêm dòng này để ẩn "watermark"
          normalScrollElements: '.list-showroom',

        });
    });
  
  })

  $(document).ready(function() {
    var h = $('#section4').innerHeight();
    $('#map, #map_HS').css({'height': h});
  });
  

  // slcik nhat dinh
  $(document).ready(function(){
    // Kiểm tra kích thước màn hình khi tải trang
    checkWindowSize();

    // Kiểm tra kích thước màn hình khi thay đổi kích thước cửa sổ
    $(window).resize(function(){
        checkWindowSize();
    });
});

function checkWindowSize() {
    // Lấy chiều rộng của màn hình
    var windowWidth = $(window).width();

    // Điều kiện để kiểm tra
    if (windowWidth <= 425) {
        // Nếu màn hình lớn hơn hoặc bằng 768px, thì khởi tạo Slick.js
        $(".sevices-content .row").slick({
          arrows: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          focusOnSelect: true,
          // autoplay: true,
          autoplaySpeed: 3000,
         
        });
      
    } else {
        // Nếu màn hình nhỏ hơn 768px, có thể thực hiện các hành động khác hoặc không sử dụng Slick.js
        // Ví dụ: $('.your-slider-class').unslick();
    }
}
