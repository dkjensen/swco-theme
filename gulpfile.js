var gulp          = require('gulp'),
    sass          = require('gulp-sass'),
    rtlcss        = require('gulp-rtlcss'),
    autoprefixer  = require('gulp-autoprefixer'),
    plumber       = require('gulp-plumber'),
    gutil         = require('gulp-util'),
    rename        = require('gulp-rename'),
    concat        = require('gulp-concat'),
    //jshint        = require('gulp-jshint'),
    minifycss     = require('gulp-uglifycss'),
    uglify        = require('gulp-uglify'),
    imagemin      = require('gulp-imagemin'),
    browserSync   = require('browser-sync').create(),
    sourcemaps    = require('gulp-sourcemaps'),
    reload        = browserSync.reload;

var onError = function( err ) {
  console.log('An error occurred:', gutil.colors.magenta(err.message));
  gutil.beep();
  this.emit('end');
};

// Sass
gulp.task('sass', function() {
  return gulp.src([
    '!./sass/custom/*.scss',
    './sass/**/*.scss'
  ])
  .pipe(plumber({ errorHandler: onError }))
  .pipe(sass({
    outputStyle: 'compressed'
  }))
  .pipe(sourcemaps.write({ includeContent: false }))
  .pipe(sourcemaps.init({ loadMaps: true }))
  .pipe(autoprefixer())
  .pipe(sourcemaps.write('./'))
  .pipe(gulp.dest('./'))
  
  //.pipe(rtlcss())                     // Convert to RTL
  //.pipe(rename({ basename: 'rtl' }))  // Rename to rtl.css

  .pipe( browserSync.stream() )
  .pipe( minifycss())

  .pipe(gulp.dest('./'));             // Output RTL stylesheets (rtl.css)
});

// JavaScript
/*
gulp.task('js', function() {
  return gulp.src(['./js/*.js'])
  .pipe(jshint())
  .pipe(jshint.reporter('default'))
  .pipe(concat('app.js'))
  .pipe(rename({suffix: '.min'}))
  .pipe(uglify())
  .pipe(gulp.dest('./js'));
});
*/

// Images
gulp.task('images', function() {
  return gulp.src('./images/src/*')
  .pipe(plumber({ errorHandler: onError }))
  .pipe(imagemin({ optimizationLevel: 7, progressive: true }))
  .pipe(gulp.dest('./images/dist'));
});

// Watch
gulp.task('watch', function() {
  browserSync.init({
    files: ['./**/*.php'],
    proxy: {
      target: 'http://malthunter.test'
    },
    notify: false
  });
  gulp.watch('./sass/**/*.scss', ['sass', reload]);
  gulp.watch('./js/*.js', ['js', reload]);
  gulp.watch('images/src/*', ['images', reload]);
});

gulp.task('default', ['sass', 'images', 'watch']);