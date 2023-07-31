const gulp = require('gulp');
const eslint = require('gulp-eslint');

const message = require('../../lib/message');

module.exports = function () {
    return gulp.src('../assets/js/**/*.js')
        .pipe(eslint())
        .pipe(eslint.format())
        .pipe(eslint.failAfterError())
        .on('error', message.error('JavaScript: Linting'));
};
