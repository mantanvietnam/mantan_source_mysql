$ = jQuery;
console.log('aaaaa')


$( document ).ready(function() {

  $('.place-img-slide').slick({

    infinite: true,

    slidesToShow: 3,

    slidesToScroll: 3,

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





 

  $('.place-around-slide').slick({

    infinite: true,

    slidesToShow: 3,

    slidesToScroll: 3,

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







