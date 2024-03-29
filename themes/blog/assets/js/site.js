/* Utility to add an event listener for an element. */
function addEvent (event, elem, func) {
    if (elem.addEventListener)
        elem.addEventListener(event, func, false);
    else if (elem.attachEvent)
        elem.attachEvent('on'+event, func);
    else
        elem[event] = func;
}

/* Utility to load JavaScript code when the page is ready. */
function loadContent (callback) {
    if (document.addEventListener) {
        document.addEventListener('DOMContentLoaded', function (ev) {
            callback(ev);
        }, false);
    }
    else {
        document.attachEvent('onreadystatechange', function (ev) {
            if ('complete' === document.readyState)
                callback(ev);
        });
    }
}

function imageLazyLoading () {
    /* The variable is set in our layouts. */
    if (!enableImageLazyLoading)
        return;

    /* TODO: We hardcode the elements and their
        class currently. We may change it later. */
    var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

    /* Load the images lazily. */
    if ("IntersectionObserver" in window) {
        let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let lazyImage = entry.target;
                    /* TODO: We hardcode the data attribute here.
                        We may change it later. */
                    lazyImage.src = lazyImage.getAttribute("data-src");
                    lazyImage.classList.remove("lazy");
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        });

        lazyImages.forEach(function(lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });
    }
    /* Load the images instantly
        if lazy loading is not supported. */
    else {
        lazyImages.forEach(function(lazyImage) {
            /* TODO: We hardcode the data attribute here.
                We may change it later. */
            lazyImage.src = lazyImage.getAttribute("data-src");
        });
    }
}

loadContent(imageLazyLoading);

function fixedSidebar () {
    /* The variable is set in our layout. */
    if (!enableFixedSidebar)
        return;

    var isMobile = {
        Android: function Android() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function BlackBerry() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        /* iPad Pro is not included. */
        iOS: function iOS() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        /* iPad Pro is desktop-like. */
        iPadPro: function iPadPro () {
            return /MacIntel/.test(navigator.platform)
                && 'ontouchend' in document;
        },
        Opera: function Opera() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function Windows() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function any() {
            return isMobile.Android()
                || isMobile.BlackBerry()
                || isMobile.iOS()
                /* iPad Pro is desktop-like. Therefore, we exclude
                    the series of tablets. */
                /* || isMobile.iPadPro() */
                || isMobile.Opera()
                || isMobile.Windows();
        }
    };

    /* Disable the fixed sidebars on mobile devices. */
    if (isMobile.any())
        return;

    var windowWidth = window.outerWidth || document.body.clientWidth;

    var fixedSidebar = document.getElementById("fixed-sidebar");
    if (!fixedSidebar)
        return;

    /* The size set in Bootstrap. */
    let pageWidthMedium = 992;

    /* Enable the fixed sidebars on large screens. */
    if (windowWidth >= pageWidthMedium)
    {
        let left;
        let width;

        /* The width here is arbitrary. If you set a different
            maximal width for containers, it may not work properly. */
        if (windowWidth >= 1400) {
            let container = 1320;
            let dw = Math.floor((windowWidth - container) / 2);
            left = Math.floor(dw + container * 9 / 12);
            width = Math.floor(container * 3 / 12);
        }
        /* The width here is arbitrary. We set it by our previous
            experience. Change it if it doesn't work well for your. */
        else if (windowWidth >= 1200) {
            let container = 1140;
            let dw = Math.floor((windowWidth - container) / 2);
            left = Math.floor(dw + container * 9 / 12);
            width = Math.floor(container * 3 / 12);
        }
        else {
            let container = 960;
            let dw = Math.floor((windowWidth - container) / 2);
            left = Math.floor(dw + container * 8 / 12);
            width = Math.floor(container * 4 / 12);
        }

        fixedSidebar.style.position = "fixed";

        /* The height of the top navbar. */
        let navbarHeight = document.getElementsByTagName('nav')[0].clientHeight;
        /* The height of the <h1> title of a page. */
        let windowHeight = document.documentElement.clientHeight || window.innerHeight;
        let headerHeight = 0.6 /* The height of the jumbotron. */ * windowHeight;

        /* The sidebar scrolls below the title bar. */
        if (window.scrollY > navbarHeight + headerHeight) {
            fixedSidebar.style.top = "0";
        }
        /* The sidebar scrolls within the title bar. */
        else {
            fixedSidebar.style.top = `${headerHeight - document.documentElement.scrollTop}px`;
        }

        fixedSidebar.style.left = `${left}`.toString() + "px";

        /* Set an high z index arbitrarily. */
        fixedSidebar.style.zIndex = "100000";

        /* Set the width of the side bar. */
        fixedSidebar.style.width = `${width}`.toString() + "px";
    }
    /* Otherwise, disable fixed sidebars. */
    else {
        fixedSidebar.style.position = "relative";
        fixedSidebar.style.top = "";
        fixedSidebar.style.zIndex = "";
    }
}

loadContent(fixedSidebar);

addEvent("scroll", window, fixedSidebar);
addEvent("resize", window, fixedSidebar);

function alignSectionTitleHeights () {
    /* Search all section blocks. */
    let sectionBlocks = document.getElementsByClassName("section-block");
    if (!sectionBlocks || 0 === sectionBlocks.length)
        return;

    /* Get the maximal height of the subtitle of the section blocks. */
    let height = -1;
    for (let i = 0; i < sectionBlocks.length; ++i) {
        let subtitle = sectionBlocks[i].getElementsByTagName("h2")[0];
        if (!subtitle)
            return;

        let elemHeight = subtitle.scrollHeight;
        if (elemHeight > height)
            height = elemHeight;
    }

    /* Set the height of all `<h2>` tags. */
    for (let i = 0; i < sectionBlocks.length; ++i) {
        let subtitle = sectionBlocks[i].getElementsByTagName("h2")[0];
        if (!subtitle)
            return;

        subtitle.style.height = `${height}px`;
    }
}

loadContent(alignSectionTitleHeights);
