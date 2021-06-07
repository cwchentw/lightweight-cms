const isdev = require('isdev');

const gulp = require('gulp');
const gulpif = require('gulp-if');

const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

const message = require('../../lib/message');

module.exports = function () {
    return gulp.src('../assets/js/**/*.js')
        .pipe(babel({
            presets: ['@babel/preset-flow', '@babel/preset-env']
        }))
        .on('error', message.error('JavaScript: Building'))
        .pipe(gulpif(!isdev, uglify()))
        .on('error', message.error('JavaScript: Minification'))
        .pipe(gulp.dest('../public/js'));
};
