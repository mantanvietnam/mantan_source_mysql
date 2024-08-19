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
        arrows: true,
        focusOnSelect: true
    });
    $('.main-carousel').flickity({
        // options
        cellAlign: 'center',
        contain: true,
        prevNextButtons:false,
        wrapAround: true,
        pageDots:false
    });
  
});


function plusQuantity() {
    const quantityInput = document.getElementById('quantity_buy');
    let currentValue = parseInt(quantityInput.value, 10);
    if (!isNaN(currentValue)) {
        quantityInput.value = currentValue + 1;
    }
}

function minusQuantity() {
    const quantityInput = document.getElementById('quantity_buy');
    let currentValue = parseInt(quantityInput.value, 10);
    if (!isNaN(currentValue) && currentValue > 1) { // Prevent going below 1
        quantityInput.value = currentValue - 1;
    }
}