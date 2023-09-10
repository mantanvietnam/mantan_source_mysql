$(document).ready(function() {
 
    // topbar
    $(".language-box").hide();
    $(".change-language span").click(function(){
      $(".language-box").toggle();
    });

    // test slick
    $a= $('#section-photo > div.photo-content > div.photo-slide.slick-initialized.slick-slider > div > div > div.photo-item.slick-slide.slick-active:first-child()').css('padding', '10px');
    $b= $('main')
    console.log($a.html());

    // dem so
    const classOdometer = document.querySelector('.odometer')
    const odometer = new Odometer({
      el:classOdometer,
      duration: 5000
    })
    classOdometer.innerHTML = 20;

    const classOdometer2 = document.querySelector('.odometer2')
    const odometer2 = new Odometer({
      el:classOdometer2,
      duration: 5000
    })
    classOdometer2.innerHTML = 200;

    const classOdometer3 = document.querySelector('.odometer3')
    const odometer3 = new Odometer({
      el:classOdometer3,
      duration: 5000
    })

    classOdometer3.innerHTML = 9;

    const classOdometer4 = document.querySelector('.odometer4')
    const odometer4 = new Odometer({
      el:classOdometer4,
      duration: 5000
    })

    classOdometer4.innerHTML = 8;
});





  