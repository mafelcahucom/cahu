/**
 * Gulp Task.
 *
 * @since 1.0.0
 */

var gulp 				= require('gulp');
var gulp_rename 		= require('gulp-rename');
var gulp_concat 		= require('gulp-concat');
var gulp_include 		= require('gulp-include');

// plugin for css
var gulp_sass 			= require('gulp-sass');
var gulp_sourcemap 		= require( 'gulp-sourcemaps' );
var gulp_autoprefixer 	= require( 'gulp-autoprefixer' );

// plugin for js
var babelify 			= require( 'babelify' );
var browserify 			= require( 'browserify' );
var gulp_uglify 		= require( 'gulp-uglify' );
var vinyl_source 		= require( 'vinyl-source-stream' );
var vinyl_buffer 		= require( 'vinyl-buffer' );


/**
 * CSS Task - compiling scss into minified css
 * and add sourcemap.
 *
 * @since 1.0.0
 */
var css_src   = './assets/src/scss/*.scss';
var css_dist  = './assets/dist/css/';
var css_watch = 'assets/src/scss/**/*.scss';
function cssTask( done ) {
	gulp.src( css_src )
		.pipe( gulp_sourcemap.init() )
		.pipe( gulp_sass({ 
			outputStyle: 'compressed' 
		}).on( 'error', gulp_sass.logError ))
		.pipe( gulp_autoprefixer({
			cascade: false
		}))
		.pipe( gulp_rename({
			suffix: '.min'
		}))
		.pipe( gulp_sourcemap.write( './' ) )
		.pipe( gulp.dest( css_dist ) );
	done();
}
gulp.task( 'css_task', cssTask );

/**
 * JS Task - compiling javascript and convert into babel
 * and minify and add sourcemap.
 *
 * @since 1.0.0
 */
var js_folder = 'assets/src/js/';
var js_dist   = './assets/dist/js/';
var js_files  = [ 'app.js' ];
var js_watch  = 'assets/src/js/*.js'; 
function jsTask( done ) {
	js_files.map( function( file ) {
		return browserify({
			entries: [ js_folder + file ]
		})
		.transform( babelify, {
			presets: ['@babel/env']
		})
		.bundle()
		.pipe( vinyl_source( file ) )
		.pipe( gulp_rename({
			suffix: '.min'
		}))
		.pipe( vinyl_buffer() )
		.pipe( gulp_sourcemap.init({
			loadMaps: true
		}))
		.pipe( gulp_uglify() )
		.pipe( gulp_sourcemap.write( './' ) )
		.pipe( gulp.dest( js_dist ) );
	});
	done();
}
gulp.task( 'js_task', jsTask );

/**
 * Bundle task - budle multiple files into single. Note only
 * use during deploying in the production.
 *
 * @since 1.0.0
 */
function bundleTask( done ) {
	return gulp.src('./src/manifest/bundle-css.js')
		.pipe( gulp_include() )
		.pipe( gulp_rename('bundled-front-page.css'))
		.pipe( gulp.dest('./assets/bundled/') )
	done();
}
gulp.task( 'bundle', bundleTask );

/**
 * Watch task - watch all the files defined inside, any
 * changes in the file will automatically trigger the task.
 *
 * @since 1.0.0
 */
function watchTask() {
	gulp.watch( css_watch, cssTask );
	gulp.watch( js_watch, jsTask );
}
gulp.task( 'watch', gulp.series( watchTask ) );