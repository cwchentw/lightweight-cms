const del = require('del');

module.exports = function () {
    return del([
        "../public/css/site.css"
    ], { force: true });
};
