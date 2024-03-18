$('.collection-list').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    centerMode: true,
    centerPadding: '0',
    prevArrow:"<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
    nextArrow:"<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>",
    responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
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