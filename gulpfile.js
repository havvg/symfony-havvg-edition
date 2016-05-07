var gulp = require('gulp'),
    g = require('gulp-load-plugins')(),

    d = {
        bower: './web/vendor',
        js: './app/Resources/js',
        sass: './app/Resources/sass',
        web: './web'
    };

gulp.task('fonts', function() {
    gulp.src([
        d.bower + '/font-awesome/fonts/*.*'
    ])
    .pipe(gulp.dest(d.web + '/fonts'));
});

gulp.task('styles', function() {
    var options = {
        includePaths: [
            d.sass,
            d.bower,
            d.bower + '/bootstrap/scss',
            d.bower + '/font-awesome/scss'
        ]
    };

    return gulp.src([
        d.sass + '/styles.scss'
    ])
    .pipe(g.sass(options))
    .pipe(g.concat('styles.css'))
    .pipe(g.cleanCss())
    .pipe(gulp.dest(d.web + '/css'))
    .pipe(g.livereload())
});

gulp.task('scripts', function() {
    return gulp.src([
        d.js + '/**/*.js'
    ])
    .pipe(g.concat('app.js'))
    .pipe(g.uglify())
    .pipe(gulp.dest(d.web + '/js'))
    .pipe(g.livereload())
});

gulp.task('scripts-vendor', function() {
    return gulp.src([
        d.bower + '/jquery/dist/jquery.js',
        d.bower + '/bootstrap/dist/bootstrap.js'
    ])
    .pipe(g.concat('vendor.js'))
    .pipe(g.uglify())
    .pipe(gulp.dest(d.web + '/js'))
});

gulp.task('default', [
    'fonts',
    'styles',
    'scripts-vendor',
    'scripts'
]);

gulp.task('watch', function() {
    gulp.watch(d.sass + '/**/*.scss', ['styles']);
    gulp.watch(d.js + '/**/*.js', ['scripts']);
});
