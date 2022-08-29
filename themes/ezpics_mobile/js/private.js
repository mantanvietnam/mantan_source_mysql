
$(document).ready(function(){
	$('.tab-account a').click(function(){
        var tab_id = $(this).attr('data-tab');
        $('.tab-account a').removeClass('active');
        $('.tab-content').removeClass('active');
        $(this).addClass('active');
        $("#"+tab_id).addClass('active');
    });

    setTimeout(function(){
      $('.loading').addClass('active');
    }, 3500);

    $('.clc-forgot').click(function(){
        $('.step-1').addClass('active');
    });

    $('.clc-step-2').click(function(){
        $('.step-2').addClass('active');
    });

    $('.back-step a').click(function(){
        $(this).closest('.step-forgot').removeClass('active');
    });

    $('.item-method').click(function(){
        $('.item-method').removeClass('active');
        $(this).addClass('active');
    });

    var clicked = 0;
    $(".show-pass").click(function (e) {
         e.preventDefault();
          if (clicked == 0) {
             clicked = 1;
          } else {
              clicked = 0;
           }

        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
           input.attr("type", "text"); 
        } else {
           input.attr("type", "password");
        }
    });

    (function($){
      $.fn.countdown = function(milliseconds, callback) {
        var $el = this;
        var end, timer;
         
        // Defaults
        milliseconds = milliseconds || 60;
        end = new Date(Date.now() + milliseconds);
        
        tick();
        function formatTime(time){
          seconds = time.getSeconds();
          return seconds;
        }
        function tick() {
          var remaining = new Date(end - Date.now());
          if (remaining > 0) {
            $el.html(formatTime(remaining));
            timer = setTimeout(tick, 1000);
          } else {
            clearInterval(timer);
            if (callback) callback.apply($el); 
          }
        };
      };
      
     
      $('#timer').countdown(60 * 1000);
    })(jQuery);

    $('.slide-banner').slick({
        autoplay:false,
        arrow:false,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        prevArrow: '', 
        nextArrow: '', 
    });

    $('.slide-avarta').slick({
        autoplay:false,
        arrow:false,
        slidesToShow: 2.2,
        dots: false,
        infinite: false,
        prevArrow: '', 
        nextArrow: '', 
    });

    $('.slide-product').slick({
        autoplay:false,
        arrow:false,
        slidesToShow: 2,
        dots: false,
        prevArrow: '', 
        nextArrow: '', 
    });

    $('.clc-data-list').click(function(){
        $('.box-data-pol, .avarta-user, .back-home, body, html').addClass('active');
    });
    $('.back-home').click(function(){
        $('.box-data-pol, .avarta-user, .back-home, body, html').removeClass('active');
    });
    $('.heart a').click(function(){
        $(this).toggleClass('active');
    });
    $('.info-confirm a').click(function(){
        $('.info-confirm').slideUp(400);
        $('.content-thumb-info').slideDown(400);
    });
    $('.clc-buy').click(function(){
        $('.info-confirm').slideDown(400);
        $('.content-thumb-info').slideUp(400);
    });
    $('.yes-confirm').click(function(){
        $('.creat-layout').addClass('active');
    });
    $('.item-avarta-top').click(function(){
        $('.clc-back').removeClass('active');
        $('.box-detail-product, .back-data, .avarta-user').addClass('active');
    });
    $('.back-data').click(function(){
        $('.box-detail-product, .clc-back').removeClass('active');
        $('.back-home').click();
    });
    $('.btn-checkpass').click(function(){
        $('.checkpass').hide();
        $('.newpass').addClass('active');
    });
    $('.change-pass').click(function(){
        $('.home-card, .box-password, .btn-back-card, .user-card, .btn-back-card-home').addClass('active');
    });
    $('.btn-back-card').click(function(){
        $('.home-card, .home-card-box, .box-password, .btn-back-card, .user-card, .btn-back-card-home').removeClass('active');
    });
    $('.user-card p svg').click(function(){
        $('.hide-mn, .numb-mn').toggleClass('active');
        $(this).toggleClass('active');
    });


    $('.clc-checkout').click(function(){
        $('.box-money, html, body').addClass('active');
    });
    $('.recharge').click(function(){
        $('.home-card-box, .btn-back-card, .btn-back-card-home').addClass('active');
    });

    $('.btn-back-card-home').click(function(){
        $('.box-money, html, body').removeClass('active');

    });
})

