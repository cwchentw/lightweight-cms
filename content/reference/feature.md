---
title: Features of mdcms
mtime: 2021/7/2
weight: 2
---

## Prologue

This article lists features of mdcms. Because mdcms is still *experimental and evolving*, the list may change.

## Site-related Features

* Markdown or HTML posts
* Nested sections
* PHP-based custom pages
* [Breadcrumb](https://en.wikipedia.org/wiki/Breadcrumb_navigation) (Bootstrap 5 based)
* [Pagination](https://en.wikipedia.org/wiki/Pagination) (Bootstrap 5 based)
* No following external links
* [Sitemap](https://en.wikipedia.org/wiki/Site_map) generator
* [manifest.json](https://developer.mozilla.org/en-US/docs/Mozilla/Add-ons/WebExtensions/manifest.json) generator
* Static [service worker](https://developers.google.com/web/fundamentals/primers/service-workers)
* Dynamic [HTTP status 404](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/404) pages
* [50x](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/500).html generator
* Asset management (through [Sass](https://sass-lang.com/) and [Babel](https://babeljs.io/))

## Theme-related Features

These features are available in *default* theme:

* Mobile-responsive layouts (through [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/))
* Top navbar (Bootstrap 5 based)
* Table of Contents
* Code highlighting (through [highlight.js](https://highlightjs.org/))
* Open graphs
* Static social media sharing links (no JavaScript is required)

## Plugin-related Features

* Word count for western european text
* Reading time for western european text
* Excerpts from posts
* Google analytics tracker

## Project-related Features

* Run sites locally without Apache or Nginx (through [builtin web server](https://www.php.net/manual/en/features.commandline.webserver.php) of PHP)
* Synchronize content on a production environment (through `rsync(1)`)