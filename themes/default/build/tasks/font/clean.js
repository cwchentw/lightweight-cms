const del = require('del');

module.exports = function () {
    return del('../public/font/**/*', { force: true });
};
