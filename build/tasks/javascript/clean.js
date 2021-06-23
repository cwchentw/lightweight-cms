const del = require('del');

module.exports = function () {
    return del('../public/js/**/*', { force: true });
};
