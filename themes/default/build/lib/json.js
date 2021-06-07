const fs = require('fs');
const path = require('path');

module.exports = function (dir) {
    let dataset = {};
    let dirpath = path.resolve(dir);

    if (fs.existsSync(dirpath)) {
        let files = fs.readdirSync(dirpath)

        files.forEach(function (file) {
            dataset[path.basename(file, '.json')] = require(`${dirpath}/${file}`)
        });
    }

    return dataset;
};
