$(document).ready(function (){
    $('.slide-time-event').slick({
      centerMode: true,
      centerPadding: '60px',
      slidesToShow: 3,
      infinite: true,
      speed: 500,
      prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-caret-left"></i></button>`,
      nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-caret-right"></i></button>`,
      slidesToScroll: 1,
      asNavFor: '.in-box-event-home'
    });
    $('.in-box-event-home').slick({
      // slidesToShow: 1,
      // slidesToScroll: 1,
      asNavFor: '.slide-time-event',
      focusOnSelect: true,
      dots: false,
      infinite: true,
      arrows: true,
      speed: 500,
      fade: true,
      cssEase: 'linear',
      prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
      nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`
    });
  
    // $('.in-box-event-home').slick({
    //   dots: false,
    //   infinite: true,
    //   arrows: true,
    //   speed: 500,
    //   fade: true,
    //   cssEase: 'linear',
    //   prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
    //   nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`
    // });
  
    // $('.slide-time-event').slick({
    //   centerMode: true,
    //   centerPadding: '60px',
    //   slidesToShow: 3,
    //   infinite: true,
    //   speed: 500,
    //   prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-caret-left"></i></button>`,
    //   nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-caret-right"></i></button>`,
    // });
  });
  
  // $(document).ready(function () {
  
  
  
  //   $('.in-box-event-home').slick({
  
  //     dots: false,
  
  //     infinite: true,
  
  //     arrows: true,
  
  //     speed: 500,
  
  //     fade: true,
  
  //     cssEase: 'linear',
  
  //     prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
  
  //     nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`
  
  //   });
  
  // });
  
  
  
  // $(document).ready(function () {
  
  //   $('.slide-time-event').slick({
  //     centerMode: true,
  //     centerPadding: '60px',
  //     slidesToShow: 3,
  //     infinite: true,
  //     speed: 500,
  //     prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-caret-left"></i></button>`,
  //     nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-caret-right"></i></button>`,
  //     asNavFor: '.slider-nav'
  //   });
  //   $('.in-box-event-home').slick({
  //     slidesToShow: 1,
  //     slidesToScroll: 1,
  //     asNavFor: '.slider-for',
  //     dots: true,
  //     centerMode: true,
  //     focusOnSelect: true
  //   });
  
  
  
  //   $('.slide-time-event').slick({
  
  //     centerMode: true,
  
  //     centerPadding: '60px',
  
  //     slidesToShow: 3,
  
  //     infinite: true,
  
  //     speed: 500,
  
  //     prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-caret-left"></i></button>`,
  
  //     nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-caret-right"></i></button>`,
  
  //   });
  
  
  
  // });
  
  
  
  $(document).ready(function () {
  
  
  
    $('.box-slide-tth').slick({
  
      dots: false,
  
      infinite: true,
  
      speed: 1000,
  
      slidesToShow: 4,
  
      slidetsToScroll: 1,
  
      prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
  
      nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`,
  
      responsive: [
  
        {
  
          breakpoint: 991,
  
          settings: {
  
            slidesToShow: 3,
  
            slidesToScroll: 1,
  
          }
  
        },
  
  
  
        {
  
          breakpoint: 850,
  
          settings: {
  
            slidesToShow: 2,
  
            slidesToScroll: 1,
  
          }
  
        },
  
  
  
        {
  
          breakpoint: 600,
  
          settings: {
  
            slidesToShow: 1,
  
            slidesToScroll: 1,
  
          }
  
        },
  
      ]
  
    });
  
  
  
  });
  
  
  
  $('.box-slide-tth').on('init', function (event, slick) {
  
    $('.slick-slide').removeClass('custom-class');
  
    var firstSlide = $(slick.$slides[0]);
  
    // var secondSlide = $(slick.$slides[1]);
  
    // var thirdSlide = $(slick.$slides[2]);
  
    // var fifthSlide = $(slick.$slides[3]);
  
    firstSlide.addClass('custom-class');
  
    // secondSlide.addClass('custom-class');
  
    // thirdSlide.addClass('custom-class');
  
    // fifthSlide.addClass('custom-class');
  
  });
  
  
  
  $(document).ready(function () {
  
  
  
    $('.slide-vn360').slick({
  
      infinite: true,
  
      centerMode: true,
  
      slidesToShow: 3,
  
      infinite: true,
  
      speed: 500,
  
      prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
  
      nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`,
  
      responsive: [
  
        {
  
          breakpoint: 768,
  
          settings: {
  
            // autoplay: true,
  
            autoplaySpeed: 2000,
          }
  
        },
  
  
  
        {
  
          breakpoint: 500,
  
          settings: {
  
            // autoplay: true,
  
            autoplaySpeed: 2000
  
          }
  
        },
  
      ]
  
    });
  
  
  
  });
  
  
  
  $(document).ready(function () {
  
    $(".box-menu-map").show();
  
    $('.hide_pop-up').click(function () {
  
      $(".box-menu-map").addClass("width-no");
  
      $(".check-box-menu-map").addClass("hide");
  
      // $(".box-menu-map").removeClass("opacity-0");
  
      $(".btn-hide").addClass("to-left");
  
      $(".btn-show").removeClass("opacity-0");
  
      $(".btn-show").removeClass("transform-left");
  
    });
  
  
  
    $(".show_pop-up").click(function () {
  
      $(".box-menu-map").removeClass("width-no");
  
      $(".check-box-menu-map").removeClass("hide");
  
      $(".btn-show").removeClass("hide-pop-up");
  
      $(".btn-hide").removeClass("to-left");
  
      $(".btn-show").addClass("transform-left");
  
      $(".btn-show").addClass("opacity-0");
  
      // $(".show_pop-up").addClass("opacity-0");
  
    })
  
  });
  
  
  
  
  
  
  
  