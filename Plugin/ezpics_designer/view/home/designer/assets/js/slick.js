$ = jQuery

    $('.product-other-slide').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: `<button type='button' class='slick-prev pull-left arrow-slide'><i class="fa-solid fa-chevron-left"</button>`,
        nextArrow: `<button type='button' class='slick-next pull-right arrow-slide'><i class="fa-solid fa-chevron-right"></i></button>`,

        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
              }
            },

            {
                breakpoint: 768,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                  infinite: true,

                }
            },

            {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  infinite: true,

                }
            },
        ]

       
    });


    $( document ).ready(function() {
      $(".menu-mobile").hide();
      $(".button-header").click(function(){
          console.log('a')
          $(".menu-mobile").toggle();
      });
    });
  