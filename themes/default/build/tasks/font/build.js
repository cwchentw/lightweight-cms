const gulp = require('gulp');

const message = require('../../lib/message');

module.exports = function () {
    return gulp.src('../assets/font/**/*.{eot,woff,woff2,ttf,svg}')
        .on('error', message.error('Font: Copying'))
        .pipe(gulp.dest('../public/font'));
};
