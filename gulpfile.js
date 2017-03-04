/// GULP WORKFLOWS
'use strict';

/// DEPENDENCIES
	var gulp		= require('gulp'),
		compass		= require('gulp-compass'),
		jsHint 		= require('gulp-jshint'),
		cache		= require('gulp-cached'),
		stylish		= require('jshint-stylish'),
		clean		= require('gulp-clean'),
		runSequence = require('run-sequence'),

		browserSync = require('browser-sync'),				//https://browsersync.io/docs/gulp
		//livereload = require('gulp-livereload'),

		concat = require('gulp-concat'),
		uglify = require('gulp-uglify'),
		gulpIf = require('gulp-if'),

		gUtil = require('gulp-util');

// SETTINGS
	// Workflow selection
	var selectedReloadDelay = (true)? 6000 : 0;
	var production = false;

	// Workflow parameters
	var 	styleComments,
			sassStyle,
			uglifyJS;


// MODE CONFIGURATION
	gulp.task('config_mode', function(){
		if (production) {
			gUtil.log('Production config!');
			// Production parameters
			styleComments = false;
			sassStyle = 'compressed';
			uglifyJS = true;
		}else{
			gUtil.log('Development config!');
			// Development parameters
			styleComments = true;
			sassStyle = 'expanded';
			uglifyJS = false;
		}

		console.log(
			'\nproduction:', production,
			'\nstyleComments:', styleComments,
			'\nsassStyle:', sassStyle,
			'\nuglifyJS:', uglifyJS
		);
	});


// ASSETS
	var targetMainSass 	=	'assets/sass/style.scss';
	var sassSources 	=	['assets/sass/**/*.scss'];

	// Designate dev js files
	var scriptSources = ['assets/jsDev/*.js'];
	//  Designate dev php files
	var staticTemplates = ['./**/*.php'];

// TARGET COMPOENTS
	var buildComponents = [
		'allScript.js',
		'style.css'
	];

// CLEAN COMPONENTS
	gulp.task('clean_up', function(){
		// work around for compass overwrite fail
		console.log('Removing:', buildComponents[1]);
		gulp.src(buildComponents[1], {read: false}).pipe(clean());
	});

// COMPASS / SASS
	gulp.task('do_compass', function(){
		gulp.src(targetMainSass)
		.pipe(
			// Configure my compass...
			compass({
				sass: 'assets/sass',
				css: '.',
				comments: styleComments,
				style: sassStyle, 							// expanded for dev / compressed for prod
				image: 'assets/imgs'
			})
		)
		.on('error', gUtil.log);
		//.pipe(gulp.dest('.tmp/styles/styles.css'))		// Alternate desitnations if needed
	});


// CHECK JS
	gulp.task('check_js', function(){
		return gulp.src(scriptSources)
		.pipe(cache('linting'))
		.pipe(jsHint())
		.pipe(jsHint.reporter(stylish));
	});


// COMBINE JS
	gulp.task('combine_js', ['check_js'], function(){
		gulp.src(scriptSources)
		.pipe(concat(buildComponents[0]))
		.pipe(gulpIf(uglifyJS, uglify()))
		.pipe(gulp.dest('.'));
	});


// WATCH
	gulp.task('watch_these', function() {
		// styles
		gulp.watch(sassSources, ['do_compass'])
			.on('change', function(){
				console.log('> waiting for compass to compile the sass...');
				setTimeout(function() {
					console.log('... OK GO!');
					browserSync.reload();
				}, selectedReloadDelay);
			});
		// Templates
		gulp.watch(staticTemplates)
			.on('change', browserSync.reload);
		// Scripts
		gulp.watch(scriptSources, ['combine_js'])
			.on('change', browserSync.reload);
	});


// SERVER
	gulp.task('serve', function(){
		// Browser Sync otions: https://browsersync.io/docs/options
		browserSync.init({
			port: 3003,
			//startPath: 'http://themebench03.dev/', 			// specific starting point
			open: true,
			proxy: {
				target: 'themetree.dev',
				ws: true
			}//,
			// server: {} 			// MAMP takes care of this...
		});
	});


// GULP COMMANDS
gulp.task('default', [
	'config_mode',
	'do_compass',
	'combine_js',
	'serve',
	'watch_these'
]);

gulp.task('distribute_dev', function(){
	production = false;

	runSequence(
	'clean_up',
	'config_mode',
	'do_compass',
	'combine_js',
	function (error) {
		if (error) {
			console.log(error);
		} else {
			console.log(' DEV RELEASE FINISHED SUCCESSFULLY');
		}
	});

});

gulp.task('distribute_production', function(){
	production = true;

	runSequence(
	'clean_up',
	'config_mode',
	'do_compass',
	'combine_js',
	function (error) {
		if (error) {
			console.log(error);
		} else {
			console.log(' PRODUCTION RELEASE FINISHED SUCCESSFULLY! :0)');
		}
	});

});
