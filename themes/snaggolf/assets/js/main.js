function addProductToCart(idProduct)
{
  $.ajax({
    method: "GET",
    url: "/addProductToCart/?id_product="+idProduct
  })
  .done(function( msg ) {
    window.location = '/cart';
  });
}
$(document).ready(function () {
    $('.productDetail-main-slide').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        prevArrow:
        `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
        nextArrow:
        `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
        asNavFor: '.productDetail-sub-slide'
      });
    $('.productDetail-sub-slide').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.productDetail-main-slide',
        centerMode: true,
        prevArrow:
        `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
        nextArrow:
        `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
        arrows: true,
        focusOnSelect: true
    });
    $('.product-like-slide').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        arrows: true,
        prevArrow:
        `<button type='button' class='slick-arrow slick-prev pull-left'><i class="fa-solid fa-chevron-left"></i></button>`,
        nextArrow:
        `<button type='button' class='slick-arrow slick-next pull-right'><i class="fa-solid fa-chevron-right"></i></button>`,
      
      });
      
    // $('.main-carousel').flickity({
    //     // options
    //     cellAlign: 'center',
    //     contain: true,
    //     prevNextButtons:false,
    //     wrapAround: true,
    //     pageDots:false
    // });
  
});

let isExpanded = false;
$('#toggleButton').click(function(){
  if(!isExpanded){
    $('.product-info-tab .tab-content .intro-content').css('max-height','none')
  }
  else{
    $('.product-info-tab .tab-content .intro-content').css('max-height','240px')
  }
  isExpanded = !isExpanded;

  $('.button-show').toggleClass('before-active')
});

