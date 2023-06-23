$ = jQuery

    $('.product-other-slide').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
      
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
