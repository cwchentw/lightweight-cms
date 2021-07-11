/* Register a service worker if our target browser support it.

   Such script are invariably the same. Therefore, we place it
    in a static directory. */


(function () {
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', async function () {
            try {
                let registeration = await navigator.serviceWorker.register('/service-worker.js');
                console.log("registered:".concat(" ", registeration));
            }
            catch (err) {
                console.log(err);
            }
        });
    }
    else {
        console.log('Service worker is not supported');
    }
})();
