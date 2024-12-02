$(document).ready(function() {
	if($(window).width()<1024){
		$('#desktop_view').remove();
		$('#mobile_view').show();
	}else{
		$('#mobile_view').remove();
		$('#desktop_view').show();
	}
});