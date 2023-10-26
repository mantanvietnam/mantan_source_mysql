$('.banner-home-slide').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: false
});


$('.top-search-slide').slick({
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 1,
    arrows: true,
    prevArrow:"<button type='button' class='slick-prev pull-left slick-arrow'></button>",
    nextArrow:"<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>"
});


// Chuyên mục tin tức

$(document).ready(function(){
  $('.blog-new-slide').slick({
      slidesToScroll: 1,
      arrows: true,
      slidesToShow: 3,
      prevArrow:"<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
      nextArrow:"<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>",
      responsive: [
      {
          breakpoint: 768,
          settings: {
          arrows: false,
          slidesToShow: 3
          }
      },
      {
          breakpoint: 480,
          settings: {
              arrows: false,
              slidesToShow: 1
          }
      }
      ]
  });

  $('.comment-text-slide').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.comment-customer-slide',
    arrows:false
  });

  $('.comment-customer-slide').on('init', () => {
    $('.slick-slide[data-slick-index="-2"]').addClass('lt2');
    $('.slick-slide[data-slick-index="-1"]').addClass('lt1');
    $('.slick-slide[data-slick-index="1"]').addClass('gt1');
    $('.slick-slide[data-slick-index="2"]').addClass('gt2');
  }).slick({
  centerMode: true,
  centerPadding: 0,
  slidesToShow: 5,
  prevArrow:"<button type='button' class='slick-prev pull-left slick-arrow'><i class='fa-solid fa-angle-left'></i></button>",
  nextArrow:"<button type='button' class='slick-next pull-right slick-arrow'><i class='fa-solid fa-angle-right'></i></button>",
  asNavFor: '.comment-text-slide'
  }).on('beforeChange', (event, slick, current, next) => {
    $('.slick-slide.gt2').removeClass('gt2');
    $('.slick-slide.gt1').removeClass('gt1');
    $('.slick-slide.lt1').removeClass('lt1');
    $('.slick-slide.lt2').removeClass('lt2');

    const lt2 = (current < next && current > 0) ? current - 1 : next - 2;
    const lt1 = (current < next && current > 0) ? current : next - 1;
    const gt1 = (current < next || next === 0) ? next + 1 : current;
    const gt2 = (current < next || next === 0) ? next + 2 : current + 1;

    $(`.slick-slide[data-slick-index="${lt2}"]`).addClass('lt2');
    $(`.slick-slide[data-slick-index="${lt1}"]`).addClass('lt1');
    $(`.slick-slide[data-slick-index="${gt1}"]`).addClass('gt1');
    $(`.slick-slide[data-slick-index="${gt2}"]`).addClass('gt2');

    // Clone processing when moving from 5 to 0
    if (current === 5 && next === 0) {
      $(`.slick-slide[data-slick-index="${current - 1}"]`).addClass('lt2');
      $(`.slick-slide[data-slick-index="${current}"]`).addClass('lt1');
      $(`.slick-slide[data-slick-index="${current + 2}"]`).addClass('gt1');
      $(`.slick-slide[data-slick-index="${current + 3}"]`).addClass('gt2');
    }

    // Clone processing when moving from 0 to 5
    if (current === 0 && next === 5) {
      $(`.slick-slide[data-slick-index="${current - 1}"]`).addClass('gt2');
      $(`.slick-slide[data-slick-index="${current}"]`).addClass('gt1');
      $(`.slick-slide[data-slick-index="${current - 2}"]`).addClass('lt1');
      $(`.slick-slide[data-slick-index="${current - 3}"]`).addClass('lt2');
    }
  });

  // Chi tiết sản phẩm

  $('.product-slide-left').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.product-slide-right',
    centerMode: true,
    vertical: true,
    centerMode: true,
    focusOnSelect: true,


  });
  $('.product-slide-right').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.product-slide-left',
    arrows: false,
    fade: true
  });

  // chi tiết sản phẩm
  $('.pro-review-slide').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    prevArrow:"<button type='button' class='slick-prev pull-left slick-arrow'><</button>",
    nextArrow:"<button type='button' class='slick-next pull-right slick-arrow'>></button>",
  });

});

