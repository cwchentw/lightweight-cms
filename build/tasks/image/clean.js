const del = require('del');

module.exports = function () {
    return del('../public/img/**/*.{jpg,jpeg,png,gif,svg}', { force: true });
};
