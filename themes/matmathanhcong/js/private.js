
$(document).ready(function(){
	$('.quess').click(function(e) {
	    e.preventDefault();  
	    $(".quess").removeClass('active');
	    
	    var $this = $(this); 
	    if ($this.next().hasClass('active')) {
	        $this.removeClass('active');
	        $('.answer').removeClass('active'); 
	        $this.next().slideUp(350).removeClass('active');
	    } else {
	        $('.answer').slideUp(300).removeClass('active'); 
	        $this.toggleClass('active');
	        $this.addClass('active');
	        $this.next().slideToggle(350).addClass('active');  
	    }
	});

	function play() {
        var audio = document.getElementById("audio");
        audio.play();
    }

    function pause() {
        var audio = document.getElementById("audio");
        audio.pause();
    }

	$('.icon-audio .mp3-action a').click(function(e) {
	    e.preventDefault();  
	    $('.icon-audio .mp3-action a').toggleClass('active');
	    if($('.icon-audio .mp3-action a').hasClass('active')){
			play();
		}else{
			pause();
		}
	});

	$('.icon-audio .vol-action a').click(function(e) {
	    e.preventDefault();  
	    $('.icon-audio .vol-action a').toggleClass('active');
	    if($('.icon-audio .vol-action a').hasClass('active')){
			document.getElementById("audio").muted = true;
		}else{
			document.getElementById("audio").muted = false;
		}
	});

	$('.btn-bar a').click(function(e) {
	    e.preventDefault();  
	    $('.h-menu, html').addClass('open_menu');
	});

	$('.close-menu a').click(function(e) {
	    e.preventDefault();  
	    $('.h-menu, html').removeClass('open_menu');
	});

	$(window).bind('scroll', function() {
        var navHeight = $( window ).height();
         if ($(window).scrollTop() > 1) {
             $('.header-menu').addClass('fixed-menu'); 
         }
         else {
             $('.header-menu').removeClass('fixed-menu');
         }
    });

    $('.slide-result').slick({
        autoplay:false,
        autoplaySpeed: 5000, 
        arrow:false,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        fade: true, 
        // infinite: false, 
        touchMove: false,
	    draggable: false,
	    accessibility: false,
        speed: 300,
    });

    $('.slide-result').on('beforeChange', function(event, slick, currentSlide, nextSlide){
	    if ($('.slide-last').hasClass('slick-current')) {
	    	// alert(123); 
	    	// $('.result-step').hide();
	    	// $('.result-end').show();
	    }
	}).trigger('beforeChange');

    AOS.init({ 
    	disable: 'mobile',
	 	duration: 1200, 
	});
})

 