const del = require('del');

module.exports = function () {
    return del([
        "../public/img/logo-*.png",
        "../public/img/share-buttons/*.{jpg,jpeg,png,gif,svg}"
    ], { force: true });
};
