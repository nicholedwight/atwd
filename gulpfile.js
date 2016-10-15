var gulp = require('gulp');
var newer = require('gulp-newer');
var rename = require('gulp-rename');

var imagemin = require('gulp-imagemin');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();

gulp.task('watch', ['images', 'styles', 'scripts'], function() {
  browserSync.init({
    open: false
  });

  gulp.watch(['./assets/img'], ['images'], browserSync.reload());
  gulp.watch(['./assets/css'], ['styles']);
  gulp.watch(['./assets/js'], ['scripts']);
});

gulp.task('styles', function(cb) {
  return gulp.src('./assets/css')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./dist/assets/css'))
    .pipe(browserSync.stream());
});

// This one's got a bit of a weird approach, but it works
// heavily inspired / lifted from:
// https://fettblog.eu/gulp-browserify-multiple-bundles/
gulp.task('scripts', function(cb) {
  return gulp.src('./assets/js/main.js')
  .pipe(gulp.dest('./dist/assets/js'))
});

gulp.task('images', function(cb) {
  return gulp.src('./assets/img')
  .pipe(newer('./dist/assets/img'))
  .pipe(imagemin({
    progressive: true,
    svgoPlugins: [{
      cleanupIDs: false,
      removeUselessDefs: false,
    }]
  }))
  .pipe(gulp.dest('dist/assets/img'));
});
