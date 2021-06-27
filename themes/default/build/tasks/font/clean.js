const del = require('del');

module.exports = function () {
    return del([
        "../public/font/dsgabriele.*"
    ], { force: true });
};
