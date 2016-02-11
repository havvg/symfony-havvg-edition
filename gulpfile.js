var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    minifycss = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    merge = require('merge2');

var config = {
    bowerDir: './web/vendor',
    webDir: './web',
    sassDir: './app/Resources/sass',
    jsDir: './app/Resources/js'
};

gulp.task('fonts', function() {
    gulp.src([
        config.bowerDir + '/font-awesome/fonts/*.*'
    ])
    .pipe(gulp.dest(config.webDir + '/fonts'));
});

gulp.task('styles', function() {
    merge(
        sass(config.sassDir + '/styles.scss', {
            loadPath: [
                config.bowerDir + '/bootstrap/scss'
            ]
        }),
        gulp.src([
            config.bowerDir + '/font-awesome/css/font-awesome.min.css'
        ])
    )
    .pipe(concat('styles.css'))
    .pipe(minifycss())
    .pipe(gulp.dest(config.webDir + '/css'));
});

gulp.task('scripts', function() {
    gulp.src([
        config.jsDir + '/**/*.js'
    ])
    .pipe(concat('app.js'))
    .pipe(uglify())
    .pipe(gulp.dest(config.webDir + '/js'));
});

gulp.task('vendor-scripts', function() {
    gulp.src([
        config.bowerDir + '/jquery/dist/jquery.js',
        config.bowerDir + '/bootstrap/dist/js/bootstrap.js'
    ])
    .pipe(concat('vendor.js'))
    .pipe(uglify())
    .pipe(gulp.dest(config.webDir + '/js'));
});

gulp.task('default', [
    'fonts',
    'styles',
    'vendor-scripts',
    'scripts'
]);

gulp.task('watch', function() {
    gulp.watch(config.sassDir + '/**/*.scss', ['styles']);
    gulp.watch(config.jsDir + '/**/*.js', ['scripts']);
});
