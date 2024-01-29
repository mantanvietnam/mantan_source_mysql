var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});


// Header fixed
var scrollPage = document.getElementById("menu-top");

window.onscroll = function() {
    if (window.pageYOffset > 120 || document.documentElement.scrollTop > 120) {
        scrollPage.style.position = "fixed";
        scrollPage.style.backgroundColor = "#fff";
		scrollPage.style.left = "0";
		scrollPage.style.right = "0";
		scrollPage.style.boxShadow = "0 10px 15px rgba(25,25,25,0.1)";
		scrollPage.classList.add("scroll-header")
    } else {
        scrollPage.style.position = "relative";
        scrollPage.style.backgroundColor = "#fff";
		scrollPage.style.left = "0";
		scrollPage.style.right = "0";
		scrollPage.style.boxShadow = "none";
		scrollPage.classList.remove("scroll-header")
    scrollPage.style.boxShadow = "0 10px 15px rgba(25,25,25,0.1)";


    }
}

// gallery


$(document).ready(function() {
	$('.library-image').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
			}
		}
	});
});

// xử lý active menu
$(document).ready(function(){
  $('.navbar-nav .nav-item .nav-link').click(function(){
    $('.navbar-nav .nav-item .nav-link').removeClass('active');
    $(this).addClass('active');
  });
});


    