// console.log('Foundation configuration (ha ha that rhymed...)');
$(document).foundation();
//console.log('mainNav.js loaded!');
//console.log('shadowNav.js loaded...');


var shadowNav = {
	navTriggers: [],
	targetNavComponents: function(cb) {		
		this.navTriggers = jQuery(
			'.main-nav > .menu-item-has-children'
		);//.filter('.main-nav > li');

		if (cb) {
			return cb();
		}
	}
}


setTimeout(function() {
	shadowNav.targetNavComponents(function(){
		console.log('navTriggers', shadowNav.navTriggers);
	});
}, 1000);
console.log('simple slider controller loaded!');

$(document).ready(function(){
	$('.simple-slider').slick({
		//dots: true,
		adaptiveHeight: true,
		autoplay: true,
		autoplaySpeed: 7000,
		prevArrow: "<button type=\"button\" class=\"slick-prev\"><</button>",
		nextArrow: "<button type=\"button\" class=\"slick-next\">></button>"
	});
});