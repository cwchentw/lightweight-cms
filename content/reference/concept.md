---
title: Concepts of mdcms
mtime: 2021/6/19
---

## Synposis

mdcms stands for a flat-file based content management system powered by PHP. The software maps incoming URLs to corresponding post files on a web server. Because content of mdcms sites are stored in flat files, there is no relational database involved in such sites.

This article introduces concepts related to mdcms.

## Home Page

A home page in a mdcms site is an unique web page that deserves a dedicated layout. Such page conveys visitors general impression about a site and directs them to desired information ideally.

Web programmers typically arrange layout of a home page differently from that of section pages. Therefore, they are separated in mdcms.

## Sections

Section pages in a mdcms site are intermediate pages from a home page to posts. Most sections are purely functional. There is no substantial information for visitors in these pages.

Because sections are merely intermediaries to posts, some web programmers set `noindex` meta tag in them, which is an optional flag in mdcms.

## Posts

Posts work as real information conveyors in a mdcms site. It is abundant and relevant information that makes content websites great. Good content benefits SEO as well.

In addition to content in posts, mdcms provides metadata for each post like a title, an author, modified time and an excerpt of a post. These metadata are accessible in its layout.
