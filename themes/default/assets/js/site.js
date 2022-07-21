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

function fixedSidebar () {
    /* The variable is set in our layouts. */
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

    /* Disable fixed sidebar ads on mobile devices. */
    if (isMobile.any())
        return;

    var windowWidth = window.outerWidth || document.body.clientWidth;

    var fixedSidebar = document.getElementById("fixed-sidebar");
    if (!fixedSidebar)
        return;

    /* Sizes in Bootstrap. */
    let pageWidthMedium = 992;

    /* Enable fixed sidebars on large screens. */
    if (windowWidth >= pageWidthMedium)
    {
        let width;

        /* The width here is arbitrary because the maximal width
            of our containers is 1440. If you set a different maximal
            width for containers, it may not work properly. */
        if (windowWidth > 1440) {
            let w = 1440;
            let dw = Math.floor((windowWidth - w) / 2);
            width = Math.floor(dw + w * 9 / 12);
        }
        /* The width here is arbitrary. We set it by our previous
            experience. Change it if it doesn't work well for your. */
        else if (windowWidth >= 1140) {
            width = Math.floor(windowWidth * 9 / 12);
        }
        else {
            width = Math.floor(windowWidth * 8 / 12);
        }

        fixedSidebar.style.position = "fixed";

        /* The height of the top navbar. */
        let navbarHeight = document.getElementsByTagName('nav')[0].clientHeight;
        /* The height of the <h1> title of a page. */
        let windowHeight = document.documentElement.clientHeight || window.innerHeight;
        let headerHeight = 0.5 * windowHeight;

        console.log(windowHeight);
        console.log(headerHeight);

        /* The sidebar scrolls below both the navbar and the title bar. */
        if (window.scrollY > navbarHeight + headerHeight) {
            fixedSidebar.style.top = "0";
        }
        /* The sidebar scrolls within the navbar and the title bar. */
        else  {
            fixedSidebar.style.top = `${navbarHeight + headerHeight - document.documentElement.scrollTop}px`;
        }

        fixedSidebar.style.left = `${width}`.toString() + "px";

        /* Set an high z index arbitrarily. */
        fixedSidebar.style.zIndex = "100000";
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
