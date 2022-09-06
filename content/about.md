---
title: About
mtime: 2022/09/06
weight: 1
---

## Both Static and Dynamic

[Lightweight CMS](https://github.com/cwchentw/lightweight-cms) represents a both *static* and *dynamic* **flat-file** **content management system (CMS)** powered by PHP.

Based on the method a CMS renders web pages, a CMS is either static or dynamic. [WordPress](https://wordpress.org/) is the most famous dynamic CMS on the earth while both [Jekyll](https://jekyllrb.com/) and [Hugo](https://gohugo.io/) are popular static ones.

Dynamic CMSs are more flexible, able to add custom feature(s) as needed but consume more computing resources since all web pages managed by these systems are rendered on-the-fly each time. In contrary, static ones save hosting budgets but are difficult to customize because of the limitations imposed by static websites. Most CMSs can be ONLY static or dynamic. It is tedious to migrate from one mode to the other.

Our content management system, Lightweight CMS, can be BOTH static or dynamic. Switching from one mode to the other is merely piece of cake. If no dynamic feature is needed currently, a Lightweight CMS site can be compiled into a static website. On the other hand, if some customization are desired latter, Lightweight CMS is based on PHP, the most popular programming language for dynamic websites.

## Lightweight Markup Languages

Most static CMSs save their contents as Markdown files. We support more lightweight markup languages. The contents are stored as either [Markdown](https://github.github.com/gfm/), [AsciiDoc](https://asciidoc.org/), [reStructuredText](https://docutils.sourceforge.io/rst.html) or HTML.

Our approach combines the advantages of two worlds. Web pages in Lightweight CMS sites are rendered dynamically so that any modification will be reflected immediately. Website owners can write posts in a **lightweight markup language** instead of betting on some custom **rich-text editor**. Flat files are easier to backup and recover than database dumps and to integrate into a **version control system** like [Git](https://git-scm.com/).

## Content Caching

With the advent of **CDN service**s like [Cloudflare](https://www.cloudflare.com/), it takes virtually no effort to cache content, no matter they are from static or dynamic websites. Static sites are no longer critical for **content caching** with such services. In addition, they are of limited uses for several types of websites, such as a membership website or a mix of a blog and web application.

## Next Step

Read more [here](/reference/concept/).

This website itself is a live demonstration of Lightweight CMS, powered by a classical combination of GNU/Linux, Nginx and PHP.
