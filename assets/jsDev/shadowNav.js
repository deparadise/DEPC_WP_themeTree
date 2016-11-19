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
			var targetMenu = shadowNav.targetResetMenuContainer($(trigger), triggerIsToggle);

			var targetMenuHeight = 0;

			if (triggerIsToggle) {
				targetMenuHeight = targetMenu.children('.main-nav').height() + 75;
			}else{
				targetMenuHeight = $(targetMenu).height();
			}
			// console.log('TEST targetMenuHeight:', targetMenuHeight);

			var shadowOpen = function() {
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
			};
			var shadowClose = function() {
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
			};

			if (triggerIsToggle) {
				// device menu toggle
				$(trigger).click(function() {
					//console.log('toggleIsOpen:', toggleIsOpen);
					if (toggleIsOpen) {
						shadowClose();
						toggleIsOpen = false;
					}else{
						shadowOpen();
						toggleIsOpen = true;
					}
				});
			}else{
				// Nav links hover
				$(trigger).hover(shadowOpen, shadowClose);
			}

			if (callback) {
				return callback(null);
			}
		},
		removeNavBehavior: function(cb) {
			var shadowNav = this;

			async.eachOfSeries(
				//
				shadowNav.navTriggers,
				//
				function(trigger, index, seriesCB) {
					$(trigger).off();
					var targetMenu = shadowNav.targetResetMenuContainer($(trigger));
					
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
		assignNavToggleBehavior: function(cb) {
			shadowNav.setShadowBehaviorOn(this.deviceNavToggle, cb);
			//return cb(null);
		},
		assignNavTriggerBehavior: function(cb) {
			var shadowNav = this;

			async.eachOfSeries(
				//
				shadowNav.navTriggers,
				//
				function(trigger, index, seriesCB) {
					shadowNav.setShadowBehaviorOn(trigger, seriesCB);
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
		testApplyWindowChange: function(cb) {
			var shadowNav = this;

			// to Device
			if (shadowNav.windowWidth <= shadowNav.deviceSize) {
				if (shadowNav.deviceDisplay !== true) {
					// console.log('Display changed to device!');
					shadowNav.removeNavBehavior();
					shadowNav.assignNavToggleBehavior(cb);
				} 
				shadowNav.deviceDisplay = true;
			// to Screen
			}else{
				if (shadowNav.deviceDisplay !== false) {
					// console.log('Display changed to screen!');
					shadowNav.targetResetMenuContainer(shadowNav.deviceNavToggle, true);
					shadowNav.assignNavTriggerBehavior(cb);
				} 
				shadowNav.deviceDisplay = false;
			}

			// console.log(
			// 	'Document windowWidth:', shadowNav.windowWidth//,
			// 	//'\ndeviceDisplay:', shadowNav.deviceDisplay
			// );
		},
		resizeEvent: {} // event listener assigned here
	}; // END shadowNav API


	async.waterfall(
		[
			// target device navigation toggle and triggers
			function(cb) {
				shadowNav.targetNavComponents(cb);
			},

			// Init update on window size change event
			function(cb) {
				shadowNav.resizeEvent = $(window).resize(function() {
					shadowNav.windowWidth = $(document).width();
					shadowNav.testApplyWindowChange();
				});
				
				// Initial set and test/set behaviors
				shadowNav.windowWidth = $(document).width();
				shadowNav.testApplyWindowChange(cb);
			}			
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