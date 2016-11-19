//console.log('shadowNav.js loaded...');
// var shadowNav = {};

$(document).ready(function() {

	var shadowNav = {
		windowWidth: 0,
		deviceSize: 640,
		deviceDisplay: null,
		navTriggers: [],
		deviceNavToggle: [],
		targetNavComponents: function(cb) {
			this.deviceNavToggle = $('.toggle-topbar a');

			this.navTriggers = $(
				'.main-nav > .menu-item-has-children'
			);

			if (cb) {
				return cb();
			}
		},
		targetResetMenuContainer: function(trigger, triggerIsToggle) {
			var targetMenu = [];

			if (triggerIsToggle) {
				targetMenu = $('.main-navigation.top-bar-section');
			}else{
				targetMenu = $(trigger).children('.sub-menu');
			}

			//console.log('TEST targetMenu:', targetMenu);
			targetMenu.removeAttr('style'); // reset
			
			return targetMenu;
		},
		setShadowBehaviorOn: function(trigger, callback) {
			// console.log('TEST trigger:', trigger);
			$(trigger).off(); // reset of bindings

			var toggleIsOpen = false;
			var triggerIsToggle = ($(trigger)[0].className.includes('toggle-link'))? true : false;
			// console.log('TEST triggerIsToggle:', triggerIsToggle);
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
					shadowNav.setMainNavBehaviorOn(trigger, seriesCB);
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
					// console.log('Display changed to device!');
					shadowNav.removeNavBehavior();
				} 
				shadowNav.deviceDisplay = true;
			// to Screen
			}else{
				if (shadowNav.deviceDisplay === true) {
					// console.log('Display changed to screen!');
					shadowNav.assignNavBehavior();
				} 
				shadowNav.deviceDisplay = false;
			}

			// console.log(
			// 	'Document windowSize:', shadowNav.windowSize//,
			// 	//'\ndeviceDisplay:', shadowNav.deviceDisplay
			// );
		},
		resizeEvent: {} // event listener assigned here
	}; // END shadowNav API


	async.waterfall(
		[
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
			},
			// target triggers
			function(cb) {
				shadowNav.targetNavComponents(function(){
					//console.log('navTriggers', shadowNav.navTriggers);
					return cb(null);
				});
			},
			// Behavior
			function(cb) {
				if (shadowNav.deviceDisplay) {
					// do nothing...
					return cb(null);
				}else{
					shadowNav.assignNavBehavior(cb);	
				}
			},
			
		],
		function(err) {
			if (err) {
				console.error(err);
			}else{
				// console.log(
				// 	'> the Shadow Nav is setup!'
				// 	//, shadowNav
				// );
			}
		}
	); // END shadowNav init process

///
}); // END shadowNav.js module