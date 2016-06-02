/// DEPENDENCIES
	var 	gulp = require('gulp'),
			compass = require('gulp-compass'),
			concat = require('gulp-concat'),
			gulpIf = require('gulp-if'),
			jsHint = require('gulp-jshint'),
			livereload = require('gulp-livereload'),
			uglify = require('gulp-uglify');
			gutil = require('gulp-util');

/// WORKFLOW
	// Workflow parameters
	var 	production,
			sassStyle,
			uglifyJS;
	
	// Workflow selection
	production = false;
	
	if (production === true) {
		// Production parameters
		 sassStyle = 'compressed';
		 uglifyJS = true;
		 gutil.log('Process for production!');
	}else{
		// Development parameters
		 sassStyle = 'expanded';
		 uglifyJS = false;
		 gutil.log('Process for development!');
	}
	

/// ASSET SOURCE LIST
	// Designate dev js files
	var jsSources = ['assets/jsDev/*.js']; 
	//  Designate dev php files
	var staticSources = ['./**/*.php'];
	// Designate dev sass files
	var sassSources = ['assets/sass/**/*.scss'];
	
	
/// GULP PIPE FUNCTIONS
	// static >>> all php static files pipe
	gulp.task('static', function(){
		gulp.src(staticSources)
		.pipe(livereload())
	});

	// compass >>> Styles pipe
	gulp.task('compass', function(){
		gulp.src('assets/sass/style.scss')
		.pipe(compass({
			// COMPASS CONFIGURATION
			sass: 'assets/sass',
			css: '.',
			comments: true,
			style: sassStyle,  // expanded for dev / compressed for prod
			image: 'assets/imgs'
		})
		.on('error', gutil.log))
		.pipe(gulp.dest('.'))
		.pipe(livereload())
	});

	// js >>> Script files pipe
	gulp.task('js', function(){
		gulp.src(jsSources)
		
		.pipe(jsHint())
		.pipe(jsHint.reporter('default'))
		
		.pipe(concat('allScript.js'))
		.pipe(gulpIf(uglifyJS === true, uglify()))
		.pipe(gulp.dest('assets/js'))
		.pipe(livereload())
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