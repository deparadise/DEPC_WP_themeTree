//console.log('shadowNav.js loaded...');
var shadowNav = {};

$(document).ready(function() {

	shadowNav = {
		windowSize: 0,
		deviceSize: 640,
		deviceDisplay: false,
		navTriggers: [],
		targetNavComponents: function(cb) {		
			this.navTriggers = jQuery(
				'.main-nav > .menu-item-has-children'
			);//.filter('.main-nav > li');

			if (cb) {
				return cb();
			}
		},
		resetTargetMenuStyleAttr: function(trigger) {
			var targetMenu = $(trigger).children('.sub-menu');
			targetMenu.removeAttr('style'); // reset
			return targetMenu;
		},
		setMainNavBehaviorOn: function(trigger, seriesCB) {
			//console.log('test trigger:', trigger);
			var targetMenu = shadowNav.resetTargetMenuStyleAttr(trigger);

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
		removeNavBehavior: function(cb) {
			var shadowNav = this;

			async.eachOfSeries(
				//
				shadowNav.navTriggers,
				//
				function(trigger, index, seriesCB) {
					$(trigger).off();
					var targetMenu = shadowNav.resetTargetMenuStyleAttr(trigger);
					
					return seriesCB(null);
				},
				//
				function(err) {
					if (err) {
						//err
					}else{
						//console.log('NavBehavior removed...');
						if (cb) {
							return cb(null);
						}
					}
				}
			);
		},
		assignNavBehavior: function(cb) {
			var shadowNav = this;

			async.eachOfSeries(
				//
				shadowNav.navTriggers,
				//
				function(trigger, index, seriesCB) {
					shadowNav.setMainNavBehaviorOn(trigger, seriesCB)
				},
				//
				function(err) {
					if (err) {
						//err
					}else{
						//console.log('NavBehavior assigned...');
						if (cb) {
							return cb(null);
						}
					}
				}
			);
		},
		testApplyWindowChange: function() {
			var shadowNav = this;

			// to Device
			if (shadowNav.windowSize <= shadowNav.deviceSize) {
				if (shadowNav.deviceDisplay === false) {
					console.log('Display changed to device!');
				} 
				shadowNav.deviceDisplay = true;
			// to Screen
			}else{
				if (shadowNav.deviceDisplay === true) {
					console.log('Display changed to screen!');
					// setTimeout(function() {
						shadowNav.assignNavBehavior();
					// },5000);
				} 
				shadowNav.deviceDisplay = false;
			}

			// console.log(
			// 	'Document windowSize:', shadowNav.windowSize//,
			// 	//'\ndeviceDisplay:', shadowNav.deviceDisplay
			// );
		},
		resizeEvent: {} // event listener assigned here
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
				shadowNav.assignNavBehavior(cb);
			},
			// Init update on window size change event
			function(cb) {
				shadowNav.resizeEvent = $(window).resize(function() {
					shadowNav.windowSize = $(document).width();
					shadowNav.testApplyWindowChange();
				});
				
				// Initial set and test
				shadowNav.windowSize = $(document).width();
				shadowNav.testApplyWindowChange();

				return cb(null);
			}
		],
		function(err) {
			if (err) {
				console.error(err);
			}else{
				console.log(
					'> the Shadow Nav is setup!'
					//, shadowNav
				);
			}
		}
	);

///
}); // END shadowNav.js