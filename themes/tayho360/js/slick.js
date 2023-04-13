console.log('a');
$(document).ready(function () {
  $('.place-img-slide').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
      nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`,
  });

  $('.place-around-slide').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3,
      prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
      nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`,
      responsive: [
          {
              breakpoint: 1060,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
              }
          },
          {
              breakpoint: 1060,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
              }
          },
          {
              breakpoint: 800,
              settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
              }
          },
      ]
  });

  $('#skct-lien-quan .g-3').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`,
    responsive: [
        {
            breakpoint: 1060,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            }
        },
        {
            breakpoint: 1060,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,

            }
        },
        {
            breakpoint: 800,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        },
    ]
});
    // hien vat
    $('.artifacts-slide-top').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow:`<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
        nextArrow:`<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`,
        asNavFor:'.artifacts-slide-bot',
    });

    $('.artifacts-slide-bot').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true,
        focusOnSelect: true,
        prevArrow:`<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
        nextArrow:`<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`,
        asNavFor:'.artifacts-slide-top',
    });


    // chi tiết di tích hiện vật
    $('.place-artifacts-slide').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow:`<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,
        nextArrow:`<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`,
        responsive: [
          {
            breakpoint: 1060,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          },
    
          {
            breakpoint: 1060,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          },
    
          {
            breakpoint: 800,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          },
        ]
      });



});







