/* A service worker script.

   Such script are seldom changed. Therefore, we place it
    in a static directory. */


var CACHE_VERSION = 'version1';
var OFFLINE_URL = 'offline.html';

function update (req) {
    return fetch(req)
        .then (function (res) {
            let c = res.clone();
            caches.open(CACHE_VERSION).then(function (cache) {
                cache.put(req, c);
            });
            return res;
        });
}

/* Update the base URL when migrating a website. */
var BASE_URL = 'learnc.onl';

self.addEventListener('fetch', function (event) {
    if (event.request.url.match(BASE_URL)) {
        event.respondWith(
            caches.match(event.request)
                .then(function (res) {
                    return res || update(event.request);
                })
                .catch(function () {
                    return caches.match(OFFLINE_URL);
                })
        );

        event.waitUntil(
            caches.open(CACHE_VERSION)
                .then(function (cache) {
                    return update(event.request);
                })
        );
    }
});

var CURRENT_CACHE = {
    offline: 'offline-cache' + CACHE_VERSION
};

let CACHE_LIST = [];

self.addEventListener('install', function (event) {
    if (!('caches' in self)) {
        return;
    }

    event.waitUntil(
        caches.open(CURRENT_CACHE.offline)
            .then(function (cache) {
                return cache.addAll(CACHE_LIST);
            })
    );
});

self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(function (keyList) {
            return Promise.all(keyList.map(function (key) {
                if (CACHE_LIST.indexOf(key) === -1) {
                    return caches.delete(key);
                }
            }));
        })
    );
});