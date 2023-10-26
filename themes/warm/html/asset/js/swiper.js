
const swiperEl = document.querySelector('.mySwiper2')

const params = {
    injectStyles: [`
    .swiper-pagination-bullet {
    width: 20px;
    height: 20px;
    text-align: center;
    line-height: 20px;
    font-size: 21px;
    color: #000;
    opacity: 1;
    background: #fff;
    display:none;
    }

    .swiper-pagination-bullet-active {
    color: #ff6c41;
    background: #fff;

    }
    `],
    pagination: {
    clickable: true,
    renderBullet: function (index, className) {
        return '<span class="' + className + '">' + (index + 1) + "</span>";
    },
    },
}

const galleryThumbs = new Swiper(".galleryThumbs",{
  slidesPerView:7,
  grid:{
    rows:5,
  },
  spaceBetween:30,
  pagination:{
    el: ".swiper-pagination",
    clickable:true,
    type:"bullets",
  },
  breakpoints: {  
    1024:{
      slidesPerView: '7',
      spaceBetween: 20,
  },
    '480': {
      slidesPerView: 4,
      spaceBetween: 20,},
      '320': {
        slidesPerView: 3,
        spaceBetween: 10,
        grid:{
          rows:3,
        },
      },

      '991': {
        slidesPerView: 4,
        spaceBetween: 20, },
    },



});

const galleryTop = new Swiper(".galleryTop",{
    slidesPerView:1,
    spaceBetween:10,
    pagination:{
      el: ".swiper-pagination",
      clickable:true,
      type:"bullets",
    },
    thumbs:{
      swiper:galleryThumbs,
    },
  });

  const galleryThumbstwo = new Swiper(".galleryThumbstwo",{
    slidesPerView:7,
    grid:{
      rows:5,
    },
    spaceBetween:30,
    pagination:{
      el: ".swiper-pagination",
      clickable:true,
      type:"bullets",
    },
    breakpoints: {  
      1024:{
        slidesPerView: '7',
        spaceBetween: 20,
    },
      '480': {
        slidesPerView: 4,
        spaceBetween: 20,},
        '320': {
          slidesPerView: 3,
          spaceBetween: 10,
          grid:{
            rows:3,
          },
        },

        '991': {
          slidesPerView: 4,
          spaceBetween: 20, },
      },



  });

const galleryToptwo = new Swiper(".galleryToptwo",{
      slidesPerView:1,
      spaceBetween:10,
      pagination:{
        el: ".swiper-pagination",
        clickable:true,
        type:"bullets",
      },
      thumbs:{
        swiper:galleryThumbstwo,
      },

    });

    const galleryTopthree = new Swiper(".galleryTop3",{
      slidesPerView:1,
      spaceBetween:10,
      pagination:{
        el: ".swiper-pagination",
        clickable:true,
        type:"bullets",
      },
      thumbs:{
        swiper:galleryThumbstwo,
      },

    });



