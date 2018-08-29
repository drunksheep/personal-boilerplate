// npm uninstall `ls -1 node_modules | tr '/\n' ' '`

var gulp = require('gulp'),
    stylus = require('gulp-stylus'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    postcss = require('gulp-postcss'),
    sourcemaps = require('gulp-sourcemaps'),
    packer = require('css-mqpacker'),
    prefixes = require('autoprefixer'),
    cssnano = require('cssnano'),
    pump = require('pump');

gulp.task('stylus', function () {
    return gulp.src('src/stylus/*.styl')
        .pipe(stylus())
        .pipe(gulp.dest('src'));
});

gulp.task('css', function () {
    var processors = [
        prefixes({
            browsers: ['last 4 versions']
        }),
        packer(),
        cssnano({
            zindex: false,
            reduceIdents: false
        }),
    ];
    return gulp.src('src/*.css')
        .pipe(sourcemaps.init())
        .pipe(postcss(processors))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('dist'));
});

gulp.task('compress', function (done) {
    gulp.src(['src/js/*.js'])
        .pipe(concat('app.js'))
        .pipe(uglify())
        .pipe(gulp.dest('dist'));
    done();
});

gulp.task('uglify-debug', function (cb) {
    pump([
        gulp.src('src/js/*.js'),
        concat('app.js'),
        uglify(),
        gulp.dest('dist')
    ], cb);
});

gulp.task('watch', function (done) {
    gulp.watch('src/stylus/**/*.styl', gulp.series('stylus', 'css'));
    gulp.watch('src/js/**/*.js', gulp.series('compress'));
    done();
});

gulp.task('default', gulp.series('stylus', 'css', 'compress', 'watch'));