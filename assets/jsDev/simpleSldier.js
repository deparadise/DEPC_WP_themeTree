console.log('simple slider controller loaded!');

$(document).ready(function(){
	$('.simple-slider').slick({
		//dots: true,
		adaptiveHeight: true,
		// mobileFirst: true,
		autoplay: true,
		autoplaySpeed: 9000,
		prevArrow: "<button type=\"button\" class=\"slick-prev\"><</button>",
		nextArrow: "<button type=\"button\" class=\"slick-next\">></button>"
	});
});