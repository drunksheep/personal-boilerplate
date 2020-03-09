// npm uninstall `ls -1 node_modules | tr '/\n' ' '`

const gulp = require('gulp'),
    stylus = require('gulp-stylus'),
    postcss = require('gulp-postcss'),
    sourcemaps = require('gulp-sourcemaps'),
    prefixes = require('autoprefixer'),
    cssnano = require('cssnano'),
    concat = require('gulp-concat'),
    babel = require('gulp-babel'),
    terser = require('gulp-terser');

const config = {
    js : {
        src: 'src/js/*.js',
    },
    css : {
        src: 'src/stylus/main.styl',
        watch: 'src/stylus/**/*.styl',
    },
    dist: 'dist',
    postCSSModules : [
        prefixes(),
        cssnano({ zindex: false, reduceIdents: false }),
    ]
};

gulp.task('js', () => {
    return gulp.src(config.js.src)
    .pipe(sourcemaps.init())
    .pipe(babel({
        presets : ['@babel/preset-env']
    }))
    .pipe(concat('app.js'))
    .pipe(terser())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(config.dist))
});

gulp.task('css', () => {
    return gulp.src('src/stylus/main.styl')
        .pipe(stylus())
        .pipe(sourcemaps.init())
        .pipe(postcss(config.postCSSModules))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(config.dist));
});

gulp.task('watch', (done) => {
    gulp.watch(config.css.watch, gulp.series('css'));
    gulp.watch(config.js.src , gulp.series('js'));
    done;
});

gulp.task('default', gulp.series('js', 'css', 'watch',));