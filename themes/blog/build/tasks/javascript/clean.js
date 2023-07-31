const del = require('del');

module.exports = function () {
    return del([
        "../public/js/site.js"
    ], { force: true });
};
