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