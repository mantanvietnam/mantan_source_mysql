$(document).ready(function(){
  $('.banner-home-slide').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows:false,
      autoplay: true,
      autoplaySpeed: 3000,
  });

  $('.news-highligh-slide').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows:false,
    asNavFor: '.news-highlight-child-slide'
  });

  $('.news-highlight-child-slide').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.news-highligh-slide',
    centerMode: true,
    focusOnSelect: true
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
      infinite: true,
      arrows: true,
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

  $('#section-page-further .news-slide').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows:false,
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

    // MEDIA
    $('.photo-slide-top').slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows:true,
      prevArrow:
      `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-caret-left"></i></button>`,
      nextArrow:
      `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-caret-right"></i></button>`,
      asNavFor: '.photo-slide-bottom',
      // arrows:false,
  
    
    });
  
    $('.photo-slide-bottom').slick({
      infinite: true,
      slidesToShow: 9,
      slidesToScroll: 1,
      arrows:true,
      prevArrow:
      `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
      nextArrow:
      `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
      asNavFor: '.photo-slide-top',
      focusOnSelect: true,
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
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
      ]
    });
  
  
    $('.news-press-slide').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3,
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
            slidesToScroll: 1,
            arrows:false,
  
          }
        },
        
        {
          breakpoint: 560,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows:false,
  
          }
        }
      ]
  
  });
    
// Bo sung

$('.slide-ourproject-video-inner').slick({
  infinite: true,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows:true,
  prevArrow:
  `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
  nextArrow:
  `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
});


$('.ourproject-slide-top').slick({
  infinite: true,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows:true,
  prevArrow:
  `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
  nextArrow:
  `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
  asNavFor: '.photo-slide-bottom',
  arrows:false,
});

});

