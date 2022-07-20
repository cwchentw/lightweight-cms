---
title: About Lightweight CMS
mtime: 2022/07/20
weight: 1
---

[Lightweight CMS](https://github.com/cwchentw/lightweight-cms) represents a flat-file based dynamic website generator powered by PHP.

Unlike static website generators, HTML pages in the websites managed by Lightweight CMS are rendered dynamically, as all PHP-powered sites. Nonetheless, these sites don't rely on any relational database for content storage. Contents in such sites are stored as flat files, either Markdown, AsciiDoc, reStructuredText or HTML pages.

Our approach combines the advantages of two worlds. Web pages in Lightweight CMS managed sites are rendered dynamically so that any modification will be reflected immediately. Website owners can write posts in a simple and lightweight markup language instead of betting on some custom online editors. Flat files are easier to backup and recover than database dumps.

With the advent of CDN services like Cloudflare, it takes virtually no effort to cache content, no matter they are from static or dynamic websites. Static sites are no longer critical with such services. In addition, they are of limited uses for several types of websites, such as a membership website or a mix of a blog and web application.

This website itself is a live demonstration of Lightweight CMS, powered by a classical combination of GNU/Linux, Nginx and PHP.
