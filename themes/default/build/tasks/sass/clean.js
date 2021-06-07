const del = require('del');

module.exports = function () {
    return del('../public/css/**/*', { force: true });
};
