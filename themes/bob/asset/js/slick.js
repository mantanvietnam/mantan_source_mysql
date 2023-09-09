$(document).ready(function(){
    $('.banner-home-slide').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows:false,
        dots: true

    });
});


  var swiper = 
  new Swiper('.swiper-du-an-details',{
    slidesPerView: '2',
    spaceBetween: 60,
    autoplay: false,
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    // slidesPerView: 'auto',
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows : true,
    },
        navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        1024: {
            spaceBetween: 0,
            slidesPerView: '1.5',

        },
        768:{
            spaceBetween:0,
            slidesPerView: '1.5',
        },
        691:{
            spaceBetween:false,
            slidesPerView: '1.5',
            navigation:false,

        },
        621:{
            navigation:false,
            spaceBetween:0,
            slidesPerView: '1.5',
        },
        558:{
            navigation:false,
            spaceBetween:0,
            slidesPerView: '1.5',
        },
        502:{
            navigation:false,
            spaceBetween:0,
            slidesPerView: '1.5',
        },
        451:{
            navigation:false,
            spaceBetween:0,
            slidesPerView: '1.5',
        },
        405:{
            navigation:false,
            spaceBetween:0,
            slidesPerView: '1.5',
        },
        364:{
            navigation:false,
            spaceBetween:0,
            slidesPerView: '1.5',
        },
        327:{
            navigation:false,
            spaceBetween:0,
            slidesPerView: '1.5',
        },

        
  }
}
 );
 var swiper = 
 new Swiper('.swiper-project',{
   slidesPerView: '3',
   spaceBetween: 60,
   autoplay: false,
   grabCursor: true,
       navigation: {
     nextEl: '.swiper-button-next',
     prevEl: '.swiper-button-prev',
   },
});

var swiper = 
new Swiper('.swiper-related',{
  slidesPerView: '5',
  spaceBetween: 20,
  autoplay: false,
  grabCursor: true,
      navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    1400:{
        slidesPerView: '5',
    },
    768: {
        slidesPerView: '3',
    },
    250:{
        slidesPerView: '2.5',
    }
}
});
