---
title: About
mtime: 2022/07/25
weight: 1
---

[Lightweight CMS](https://github.com/cwchentw/lightweight-cms) represents a flat-file based dynamic website generator powered by PHP.

Unlike the HTML pages compiled by static website generators, the web pages managed by our software are rendered dynamically, as all PHP-powered sites. Nonetheless, these sites don't rely on any database for content storage. The contents are stored as flat files, either [Markdown](https://github.github.com/gfm/), [AsciiDoc](https://asciidoc.org/), [reStructuredText](https://docutils.sourceforge.io/rst.html) or HTML.

Our approach combines the advantages of two worlds. Web pages in Lightweight CMS sites are rendered dynamically so that any modification will be reflected immediately. Website owners can write posts in a lightweight markup language instead of betting on some custom rich-text editor. Flat files are easier to backup and recover than database dumps and to integrate into a version control system like [Git](https://git-scm.com/).

With the advent of CDN services like [Cloudflare](https://www.cloudflare.com/), it takes virtually no effort to cache content, no matter they are from static or dynamic websites. Static sites are no longer critical for content caching with such services. In addition, they are of limited uses for several types of websites, such as a membership website or a mix of a blog and web application.

This website itself is a live demonstration of Lightweight CMS, powered by a classical combination of GNU/Linux, Nginx and PHP.
