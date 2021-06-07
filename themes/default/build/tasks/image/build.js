const isdev = require('isdev');

const gulp = require('gulp');
const gulpif = require('gulp-if');

const imagemin = require('gulp-imagemin');

const message = require('../../lib/message');

module.exports = function () {
    return gulp.src('../assets/img/**/*.{jpg,jpeg,png,gif,svg}')
        .pipe(gulpif(!isdev, imagemin()))
        .on('error', message.error('Image: Minification'))
        .pipe(gulp.dest('../public/img'));
};
