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