const isdev = require('isdev');

const gulp = require('gulp');
const gulpif = require('gulp-if');

const sass = require('gulp-sass')(require('sass'));
const sassGlob = require('gulp-sass-glob');
const cleancss = require('gulp-clean-css');
const prefix = require('gulp-autoprefixer');

const message = require('../../lib/message');

module.exports = function () {
    return gulp.src('../assets/sass/**/*.scss')
        .pipe(sassGlob())
        .pipe(sass())
        .on('error', message.error('SASS: Compilation'))
        .pipe(prefix({
            cascade: false
        }))
        .pipe(gulpif(!isdev, cleancss()))
        .pipe(gulp.dest('../public/css'));
};
