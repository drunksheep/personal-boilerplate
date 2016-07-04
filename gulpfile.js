// npm uninstall `ls -1 node_modules | tr '/\n' ' '`


var gulp = require('gulp'), 
stylus = require('gulp-stylus'),
gcmq = require('gulp-group-css-media-queries');

//DEFAULT
//----------------------------------------------------------------------

gulp.task('default', ['stylus', 'watch']);

	
// COMPÌLE
//----------------------------------------------------------------------

gulp.task('stylus', function(){
	return gulp.src('css/stylus/*.styl')
	.pipe(stylus())
	.pipe(gulp.dest('css'));
});


//COMPRESS
//----------------------------------------------------------------------

gulp.task('compress', function () {
  return gulp.src('./css/stylus/*.styl')
    .pipe(stylus({
      compress: false
    }))
    .pipe(gulp.dest('./css'));
});

// WATCH
//----------------------------------------------------------------------

gulp.task('watch', function() {
	gulp.watch('css/stylus/**/*.styl', ['stylus', 'compress']);
});

//MEDIA QUERY COMBINER FOR PREPROCESSOR NESTING 
//----------------------------------------------------------------------
 
gulp.task('gcmq', function () {
	gulp.src('css/*.css')
		.pipe(gcmq())
		.pipe(gulp.dest('css'));
});