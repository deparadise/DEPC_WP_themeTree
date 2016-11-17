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
		setMainNavBehaviorOn: function(trigger, seriesCB) {
			//console.log('test trigger:', trigger);
			var targetMenu = $(trigger).children('.sub-menu');
			// $(targetMenu).css({
			// 	'display' : 'none'//,
			// 	//'opacity' : '0'//,
			// 	//height
			// 	//'border' : '1px solid green'
			// });

			$(trigger).hover(
				function() {
					//$(this).css('border','1px solid blue');
					$(targetMenu).css('display', 'none').fadeIn();
				},
				function() {
					//$(this).css('border','1px solid fuchsia');
					$(targetMenu).css('display', 'block').fadeOut();
				}
			);

			return seriesCB(null);
		},
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