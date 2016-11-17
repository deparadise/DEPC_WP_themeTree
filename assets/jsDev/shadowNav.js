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
			var targetMenuHeight = $(targetMenu).height();

			$(trigger).hover(
				// mouse in
				function() {
					// $(targetMenu).css('display', 'none').fadeIn();
					$(targetMenu)
					.stop(true)
					.css({
						'display': 'block',
						'height': '0px',
						'opacity': '0',
						// 'border': '1px solid green'
					})
					.animate({
						'height': targetMenuHeight,
						'opacity':'1'
					}, 300);
				},
				// mouse out
				function() {
					//$(targetMenu).css('display', 'block').fadeOut();
					$(targetMenu)
					.stop(true)
					.css({
						'display': 'block',
						'height': targetMenuHeight,
						'opacity': '1',
						// 'border': '1px solid green'
					})
					.stop(true)
					.animate({
						'height': '0px',
						'opacity':'0'
					}, 300, function() {
						$(targetMenu).css({
							'display': 'none'
						});
					});
				}
			);

			return seriesCB(null);
		},
		assignBehavior: function(cb) {
			var shadowNav = this;

			async.eachOfSeries(
				//
				shadowNav.navTriggers,
				//
				function(trigger, index, seriesCB) {
					shadowNav.setMainNavBehaviorOn(trigger, seriesCB)

					// return seriesCB(null);
				},
				//
				function(err) {
					if (err) {
						//err
					}else{
						return cb(null);
					}
				}
			);
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