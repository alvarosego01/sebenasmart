
'use strict';

const browserSync = require('browser-sync').create(),
  reload = browserSync.reload,
  gulp = require('gulp'),
  // autoprefixer = require('gulp-autoprefixer'),
  sass = require('gulp-dart-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  csso = require('gulp-csso'),
  pump = require('pump'),
  uglify = require('gulp-uglify'),
  concat = require('gulp-concat'),
  plumber = require('gulp-plumber'),
  scp = require('gulp-scp2'),
  autoprefixer = require('autoprefixer'),
  postcss = require('gulp-postcss'),
  watch = require('gulp-watch');
var i;
// browser-sync task for starting the server.

gulp.task('browserSync-Local', () => {
  //watch files

  browserSync.init({
    logPrefix: "sebenasmart",
    open: false,
    http: true,
    online: false,
    notify: true,
    injectChanges: true,
    proxy: "localhost/sebenasmart/",
    files: ['dist/styles/**'],
    port: 3030,
    serveStatic: ["dist/styles"],
    // files: "assets/css/sebenasmartStyles.css",
    snippetOptions: {
        rule: {
            match: /<\/head>/i,
            fn: function (snippet, match) {
                return '<link rel="stylesheet" type="text/css" href="/sebenasmartStyles.css"/>' + snippet + match;
            }
        }
    }

  });

});

gulp.task('browserSync-Server', () => {
  //watch file
  browserSync.init({
    logPrefix: "sebenasmart",
    open: true,
    https: true,
    online: true,
    notify: true,
    injectChanges: true,
    proxy: "https://sebenasmart.com/",

  serveStatic: ["dist/styles"],
    files: "dist/styles/global.css",
    snippetOptions: {
        rule: {
            match: /<\/head>/i,
            fn: function (snippet, match) {
                return '<link rel="stylesheet" type="text/css" href="/sebenasmartEstilos.css"/>' + snippet + match;
            }
        }
    }

});
});

// C:\xampp2\htdocs\sebenasmart\wp-content\themes\oceanwp-child\resources\assets\styles

gulp.task('sass', () => {
  return gulp.src('./resources/assets/styles/*.sass')
    .pipe(watch('./resources/assets/styles/**/*.sass'))
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(postcss([ autoprefixer() ]))
    .pipe(csso())
    .pipe(gulp.dest('./dist/styles'))
    .pipe(browserSync.stream());
});

gulp.task('sassGeneral', () => {
  return gulp.src('./resources/assets/styles/**/*.sass')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(postcss([ autoprefixer() ]))
    .pipe(csso())
    .pipe(gulp.dest('./dist/styles'))
    .pipe(browserSync.stream());
});

gulp.task('js', () => {
  return gulp.src('./resources/assets/scripts/**/*.js')
    .pipe(watch('./resources/assets/scripts/**/*.js'))
    .pipe(plumber(
      // {errorHandler: errorScripts},
      function (error) {
        console.log(error);
        this.emit('end');
      }
    ))
    .pipe(uglify())
    .pipe(gulp.dest('./dist/scripts/'))
    .pipe(browserSync.stream());
});

gulp.task('jsGeneral', (cb) => {
  pump([
    gulp.src('./resources/assets/scripts/**/*.js'),
    // concat('funciones.js'),
    uglify(),
    gulp.dest('./dist/scripts/')
  ],
    cb
  );
});

gulp.task('SassJs', gulp.series(gulp.parallel('sassGeneral', 'js')));


gulp.task('watch', () => {

  gulp.watch("./resources/assets/styles/**/*.sass", gulp.series('sassGeneral'));

  gulp.watch("./resources/assets/scripts/**/*.js", gulp.series('js'));

});


gulp.task('online', gulp.series(gulp.parallel('SassJs', 'watch', 'browserSync-Server')));

gulp.task('local', gulp.series(gulp.parallel('SassJs', 'watch', 'browserSync-Local')));



