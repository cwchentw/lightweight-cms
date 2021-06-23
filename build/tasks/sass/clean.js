const del = require('del');

module.exports = function () {
    /* Set file lists to delete. */
    return del([], { force: true });
};
