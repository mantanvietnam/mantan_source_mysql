$(document).ready(function(){
    $('.banner-home-slide').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows:false,
    });

    $('.img-news-slide').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows:false,
    });

    $('.project-slide').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows:true,
        prevArrow:
        `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
        nextArrow:
        `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
        
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
              }
            },
            
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
    });

    $('.photo-slide').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows:true,
        prevArrow:
        `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
        nextArrow:
        `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
      
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            }
          },
          
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
    
    });


    $('.news-slide').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows:true,
      prevArrow:
      `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
      nextArrow:
      `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
    
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows:false,

          }
        },
        
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows:false,

          }
        }
      ]
  
  });

    $('.list-partner').slick({
      infinite: true,
      slidesToShow: 5,
      slidesToScroll: 1,
      arrows:false,
      autoplay: true,
      autoplaySpeed: 2000,
      responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 2,
            }
          },
          
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
  });
});

