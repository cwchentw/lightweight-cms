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
        iOS: function iOS() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function Opera() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function Windows() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function any() {
            return isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows();
        }
    };

    /* Disable fixed sidebar ads on mobile devices. */
    if (isMobile.any())
        return;

    /* Fixed sidebar on large screens. */
    var windowWidth = window.outerWidth || document.body.clientWidth;
    var fixedSidebar = document.getElementById("fixed-sidebar");

    if (windowWidth >= 992)
    {
        /* TODO: Check the code. */
        let width;
        if (windowWidth > 1440) {
            let w = 1440;
            let dw = Math.floor((windowWidth - w) / 2);
            width = Math.floor(dw + w * 9 / 12);
        }
        else if (windowWidth >= 1140) {
            width = Math.floor(windowWidth * 9 / 12);
        }
        else {
            width = Math.floor(windowWidth * 8 / 12);
        }

        fixedSidebar.style.position = "fixed";

        let navbarHeight = document.getElementById("navbarSupportedContent").clientHeight
        let headerHeight = document.getElementsByTagName("h1")[0].clientHeight;

        if (window.scrollY > navbarHeight + headerHeight)
            fixedSidebar.style.top = "0";
        else if (window.scrollY > navbarHeight)
            fixedSidebar.style.top = `${headerHeight}pt`;
        else
            fixedSidebar.style.top = `${navbarHeight + headerHeight}pt`;

        fixedSidebar.style.left = `${width}`.toString() + "px";
        fixedSidebar.style.zIndex = "100000";
    }
    else {
        fixedSidebar.style.position = "relative";
        fixedSidebar.style.top = "";
        fixedSidebar.style.zIndex = "";
    }
}

loadContent(fixedSidebar);

addEvent("scroll", window, fixedSidebar);
addEvent("resize", window, fixedSidebar);
