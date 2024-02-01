//animate service
$(document).ready(function(){
	$(window).scroll(function(event){
		var pos_body = $('html,body').scrollTop();
		var pos_event = $('.blog_animation').offset().top;

		if (pos_body>pos_event-700){
			$('.blog_animation').addClass('animate__animated animate__bounceInRight');
		}
	});
});