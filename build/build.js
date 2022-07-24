/* The main build script of the assets of Lightweight CMS.

   It is not really a part of Lightweight CMS. You can safely
    delete it and write your own build script. */

const fs = require('fs');
const path = require('path');

const gulp = require('gulp');
const message = require('./lib/message');

const browserSync = require('browser-sync').create();


/* SASS related tasks */
gulp.task('sass:build', require('./tasks/sass/build'));
gulp.task('sass:clean', require('./tasks/sass/clean'));
gulp.task('sass:lint', require('./tasks/sass/lint'));
gulp.task('sass:copy', function () {
  return gulp.src('../public/css/**/*.css')
    .pipe(gulp.dest('../../../public/css'));
});

/* JavaScript related tasks */
gulp.task('javascript:build', require('./tasks/javascript/build'));
gulp.task('javascript:clean', require('./tasks/javascript/clean'));
/* gulp.task('javascript:lint', require('./tasks/javascript/lint')); */
gulp.task('javascript:copy', function () {
  return gulp.src('../public/js/**/*.js')
    .pipe(gulp.dest('../../../public/js'));
});

/* Font related tasks */
gulp.task('font:build', require('./tasks/font/build'));
gulp.task('font:clean', require('./tasks/font/clean'));
gulp.task('font:copy', function () {
  return gulp.src('../public/font/**/*.js')
    .pipe(gulp.dest('../../../public/font'));
});

/* Image related tasks */
gulp.task('image:build', require('./tasks/image/build'));
gulp.task('image:clean', require('./tasks/image/clean'));
gulp.task('image:copy', function () {
  return gulp.src('../public/img/**/*.{jpg,jpeg,png,gif,svg}')
    .pipe(gulp.dest('../../../public/img'));
})

/* Static assets related asks */
gulp.task('static:copy', function () {
  return gulp.src('../static/**/*')
    .pipe(gulp.dest('../public/'));
});

/* Domain tasks */
gulp.task('sass', gulp.series('sass:clean', 'sass:lint', 'sass:build'));
gulp.task('javascript', gulp.series('javascript:clean', 'javascript:build'));
gulp.task('font', gulp.series('font:clean', 'font:build'));
gulp.task('image', gulp.series('image:clean', 'image:build'));
gulp.task('static', gulp.series('static:copy'));

function reload(done) {
  browserSync.reload();
  done();
}

/* Live reloading while editing assets.
    It doesn't always work well. */
gulp.task('watch', function () {
  browserSync.init({
    open: false,
    server: {
      baseDir: '../public',
      index: 'index.html'
    },
    callbacks: {
      ready: function (err, bs) {
        bs.addMiddleware("*", function (req, res, next) {
            if (req.domain === null) {
              res.statusCode = 404;
              res.setHeader('Content-type', 'text/html');
              let pagePath = path.join(__dirname, '..', 'public', '404.html');
              let html = fs.readFileSync(pagePath);
              res.write(html);
              res.end();

              return res;
            }

            return next;
        });
      }
    }
  });

  gulp.watch('../assets/sass/**/*.scss', gulp.series('sass', 'sass:copy', reload))
    .on('error', message.error('WATCH: Sass'));

  gulp.watch('../assets/js/**/*.js', gulp.series('javascript', 'javascript:copy', reload))
    .on('error', message.error('WATCH: JavaScript'));

  gulp.watch('../assets/font/**/*', gulp.series('font', 'font:copy', reload))
    .on('error', message.error('WATCH: Font'));

  gulp.watch('../assets/img/**/*.{jpg,jpeg,png,gif,svg}', gulp.series('image', 'image:copy', reload))
    .on('error', message.error('WATCH: Image'));

  gulp.watch('../static/**/*', gulp.series('static', reload))
    .on('error', message.error('WATCH: Static Assets'));
});

/* The default build task. */
gulp.task('default', gulp.parallel('sass', 'javascript', 'font', 'image', 'static'));

gulp.task('watch', gulp.series('watch'));
