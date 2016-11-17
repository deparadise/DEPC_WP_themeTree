//console.log('shadowNav.js loaded...');
$(document).ready(function() {

	var shadowNav = {
		navTriggers: [],
		targetNavComponents: function(cb) {		
			this.navTriggers = jQuery(
				'.main-nav > .menu-item-has-children'
			);//.filter('.main-nav > li');

			if (cb) {
				return cb();
			}
		},

		if (cb) {
			return cb();
		}
	}


	async.waterfall(
		[
			// target triggers
			function(cb) {
				shadowNav.targetNavComponents(function(){
					//console.log('navTriggers', shadowNav.navTriggers);
					return cb(null);
				});
			},
			// Behavior
			function(cb) {
				shadowNav.assignBehavior(cb);
			}
		],
		function(err) {
			if (err) {
				console.error(err);
			}else{
				console.log('> the Shadow Nav is setup!');
			}
		}
	);

///
}); // END shadowNav.js