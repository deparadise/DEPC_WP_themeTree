/// GULP WORKFLOWS
'use strict';

/// DEPENDENCIES
	var gulp		= require('gulp'),
		compass		= require('gulp-compass'),
		jsHint 		= require('gulp-jshint'),
		cache		= require('gulp-cached'),
		stylish		= require('jshint-stylish'),

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
	var 	production,
			sassStyle,
			uglifyJS;
	
	
	if (production) {
		// Production parameters
		 sassStyle = 'compressed';
		 uglifyJS = true;
		 gUtil.log('Process for production!');
	}else{
		// Development parameters
		 sassStyle = 'expanded';
		 uglifyJS = false;
		 gUtil.log('Process for development!');
	}


// ASSETS
	var targetMainSass 	=	'assets/sass/style.scss';
	var sassSources 	=	['assets/sass/**/*.scss'];

	// Designate dev js files
	var scriptSources = ['assets/jsDev/*.js']; 
	//  Designate dev php files
	var staticTemplates = ['./**/*.php'];


// COMPASS / SASS
	gulp.task('do_compass', function(){
		gulp.src(targetMainSass)
		.pipe(
			// Configure my compass...
			compass({
				sass: 'assets/sass',
				css: '.',
				comments: true,
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
		.pipe(concat('assets/js/allThemeControl.js'))
		.pipe(gulpIf(uglifyJS, uglify()))
		.pipe(gulp.dest('.'))
	});


	});


/// GULP RUNNING FUNCTIONS
// watch >>> Watches files for changes and runs workflow pipes
	gulp.task('watch', function(){
		livereload.listen();
		gulp.watch(staticSources, ['static']);
		gulp.watch(sassSources, ['compass']);
		gulp.watch(jsSources, ['js']);
	});


/// DEFAULT >>> Run all dev tasks and init 'watch'
	gulp.task('default', [
		//'static', 
		'compass', 
		'js', 
		'watch'
	]);
	
	
/// log >>> Test logging
	gulp.task('log', function(){
		gutil.log('Workflows are awesome!');
	});