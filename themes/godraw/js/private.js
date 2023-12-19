$(document).ready(function () {

  console.log('private');
  $(".menu-mm-mobie a").click(function () {
    $(".submenu").toggleSlide();
  });

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
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 4,
          dots: false,
          arrows: true
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

  $(".full-home-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    infinite: false,
    nextArrow: "",
    prevArrow: "",
    vertical: true,

  });

  $(".full-home-slider").on("wheel", function (e) {
    e.preventDefault();
    // console.log(e);
    // console.log("x", e.originalEvent.deltaX);

    if (e.originalEvent.deltaY < 0) {
      $(this).slick("slickPrev");
      console.log("â");
    } else {
      $(this).slick("slickNext");
    }
  });

  // $('.full-home-slider').on('scroll', (function(e) {
  // 	e.preventDefault();
  //   console.log(e)
  //   console.log('x', e.originalEvent.deltaX)
  //   c
  // 	if (e.originalEvent.deltaY < 0) {
  // 	  $(this).slick('slickPrev');
  // 	  console.log('â')
  // 	} else {
  // 	  $(this).slick('slickNext');
  // 	}
  //   }));
  var isMouseDown = false;
  var hasLoggedSwipeUp = false;
  var hasLoggedSwipeDown = false;
  var startY;

  $(".full-home-slider").on("mousedown", function (e) {
    isMouseDown = true;
    startY = e.clientY;
    hasLoggedSwipeUp = false;
    hasLoggedSwipeDown = false;
  });

  $(".full-home-slider").on("mousemove", function (e) {
    if (isMouseDown && !hasLoggedSwipeUp && !hasLoggedSwipeDown) {
      var deltaY = startY - e.clientY;

      if (deltaY > 0) {
        // Vuốt lên
        console.log("Vuốt lên", deltaY);
        $(this).slick("slickPrev");

        // Đặt cờ đã log vuốt lên
        hasLoggedSwipeUp = true;
      } else if (deltaY < 0) {
        // Vuốt xuống
        console.log("Vuốt xuống", deltaY);
        $(this).slick("slickNext");

        // Đặt cờ đã log vuốt xuống
        hasLoggedSwipeDown = true;
      }
    }
  });

  $(".full-home-slider").on("mouseup", function () {
    isMouseDown = false;
    // Đặt lại cờ khi nhả chuột
    hasLoggedSwipeUp = false;
    hasLoggedSwipeDown = false;
  });

  // 	var isTouchDown = false;
  // var hasLoggedSwipeUp = false;
  // var hasLoggedSwipeDown = false;
  // var startY;

  $(".full-home-slider").on("touchstart", function (e) {
    isTouchDown = true;
    startY = e.touches[0].clientY;
    hasLoggedSwipeUp = false;
    hasLoggedSwipeDown = false;
  });

  $(".full-home-slider").on("touchmove", function (e) {
    if (isTouchDown && !hasLoggedSwipeUp && !hasLoggedSwipeDown) {
      var deltaY = startY - e.touches[0].clientY;

      if (deltaY > 0) {
        // Vuốt lên
        console.log("Vuốt lên", deltaY);
        $(this).slick("slickNext");

        // Đặt cờ đã log vuốt lên
        hasLoggedSwipeUp = true;
      } else if (deltaY < 0) {
        // Vuốt xuống
        console.log("Vuốt xuống", deltaY);
        $(this).slick("slickPrev");


        // Đặt cờ đã log vuốt xuống
        hasLoggedSwipeDown = true;
      }
    }
  });

  $(".full-home-slider").on("touchend", function () {
    isTouchDown = false;
    // Đặt lại cờ khi nhả cảm ứng
    hasLoggedSwipeUp = false;
    hasLoggedSwipeDown = false;
  });

    // fullHeightDiv.style.height = 'calc(var(--vh, 1vh) * 100)';
    // let screenHeight = window.innerHeight;
    //   // Đặt chiều cao của div bằng chiều cao của màn hình khi trang được tải
    //   $(document).ready(function () {
    //     var screenHeight = window.innerHeight;
    //     $('main.main-cover').css('height', screenHeight + 'px');
    // });

    // Đặt lại chiều cao của div khi kích thước màn hình thay đổi
    $(window).resize(function () {
        var screenHeight = $(window).height();
        $('main.main-cover').css('height', screenHeight + 'px');
        console.log(screenHeight);

        // $('.full-home-slider').css('height', screenHeight + 'px');
        // console.log('a')


  //       // Lấy div cần set chiều cao

    });

    const fullHeightDiv = document.querySelector('.full-home-slider');
    console.log(fullHeightDiv);
  
    // Lấy chiều cao thực tế của viewport
    const vh = window.innerHeight * 0.01;
    
    // Set chiều cao cho div bằng CSS variable
    document.documentElement.style.setProperty('--vh', `${vh}px`);
    
    // Áp dụng cho div 
    fullHeightDiv.style.height = 'calc(var(--vh, 1vh) * 100)';
})
