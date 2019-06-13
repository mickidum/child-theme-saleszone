var gulp           = require('gulp'),
		gutil          = require('gulp-util' ),
		gulpSass       = require('gulp-sass'),
		concat         = require('gulp-concat'),
		uglify         = require('gulp-uglify'),
		cleanCSS       = require('gulp-clean-css'),
		rename         = require('gulp-rename'),
		cache          = require('gulp-cache'),
		autoprefixer   = require('gulp-autoprefixer'),
		notify         = require("gulp-notify");
		rimraf         = require("rimraf");


function sass(cb) {
	gulp.src('scss/*.scss')
	.pipe(gulpSass({
		outputStyle: 'expand'}).on("error", notify.onError()))
	.pipe(rename('rtl.css'))
	.pipe(autoprefixer(['last 2 versions']))
	.pipe(cleanCSS()) // comment on debug
	.pipe(gulp.dest('.'))
	cb();
}

function js(cb) {
	gulp.src('js/scripts.js')
	// .pipe(concat('scripts.min.js'))
	.pipe(rename('scripts.min.js'))
	.pipe(uglify())
	.pipe(gulp.dest('js'))
	cb();
}

// function watch(cb) {
// 	gulp.watch('scss/**/*.scss', gulp.parallel(sass));
// 	gulp.watch('js/**/*.js', gulp.parallel(js));
// 	cb();
// }

// function clearCache (cb) { 
// 	cache.clearAll();
// 	cb(); 
// }

// exports.clearcache = gulp.parallel(clearCache);
exports.default = function() {
  gulp.watch('scss/*.scss', sass);
  gulp.watch('js/scripts.js', js);
};