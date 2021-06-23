const del = require('del');

module.exports = function () {
    /* Set file lists to delete. */
    return del(['../public/img/howto/**/*.{jpg,jpeg,png,gif,svg}'], { force: true });
};
