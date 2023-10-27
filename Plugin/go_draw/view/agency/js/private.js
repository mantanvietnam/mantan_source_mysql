$(document).ready(function(){
	
	$('.mm-bar').click(function(){
		$('.nav-mobile').addClass('open_menu');
	})
	
	$('.close-mm a').click(function(){
		$('.nav-mobile').removeClass('open_menu');
	})

	$('.head-tab a').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('.head-tab a').removeClass('active');
		$('.content-tab').removeClass('active');

		$(this).addClass('active');
		$("#"+tab_id).addClass('active');
	})


	$('.tab-top-toturial a').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('.tab-top-toturial a').removeClass('active');
		$('.tab-content').removeClass('active');

		$(this).addClass('active');
		$("#"+tab_id).addClass('active');
	})

	var numberSpinner = (function() {
	  $('.number-spinner>.ns-btn>a').click(function() {
	    var btn = $(this),
	      oldValue = btn.closest('.number-spinner').find('input').val().trim(),
	      newVal = 0;

	    if (btn.attr('data-dir') === 'up') {
	      newVal = parseInt(oldValue) + 1;
	    } else {
	      if (oldValue > 1) {
	        newVal = parseInt(oldValue) - 1;
	      } else {
	        newVal = 1;
	      }
	    }
	    btn.closest('.number-spinner').find('input').val(newVal);
	  });
	  $('.number-spinner>input').keypress(function(evt) {
	    evt = (evt) ? evt : window.event;
	    var charCode = (evt.which) ? evt.which : evt.keyCode;
	    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	      return false;
	    }
	    return true;
	  });
	})();


	$('.slider-nav').slick({
	  arrows: false,
	  slidesToShow: 6,
	  slidesToScroll: 1,
	  asNavFor: '.slider-for',
	  dots: true,
	  focusOnSelect: true,
	  nextArrow: '',
      prevArrow: '',
      responsive: [
            {
                breakpoint: 1023,
                settings: {
                    slidesToShow: 4,
                    dots: true,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,
                    dots: true, 
                }
            },
        ],
	});

	 $('.slider-for').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: true,
	  fade: true,
	  asNavFor: '.slider-nav',
	  nextArrow: '<a href="javascript:void(0)" class="arr-right"><img src="images/slide-right.svg" class="img-fluid" alt=""></a>',
      prevArrow: '<a href="javascript:void(0)" class="arr-left"><img src="images/slide-left.svg" class="img-fluid" alt=""></a>',
	});

})