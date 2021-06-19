---
title: Concepts of mdcms
mtime: 2021/6/19
---

## Synposis

mdcms stands for a flat-file based content management system powered by PHP. The software maps incoming URLs to corresponding directories or files on a web server. Because content of mdcms sites are stored in flat files, there is no relational database involved in such sites.

This article introduces concepts related to mdcms.

## Router

Router is the hub of a mdcms site. It receives requests from a web server (Apache or Nginx), maps a URL to corresponding directory or post file and sends responses back to the server.

Users of mdcms seldom require to edit this script by themselves.

## Home Page

A home page in a mdcms site is an unique web page that deserves a dedicated layout. Such page emanates visitors general impression about a site and directs them to desired information ideally.

Web programmers typically arrange layout of a home page differently from that of section pages. Therefore, they are separated in mdcms.

## Sections

Sections or section pages in a mdcms site are in-between pages from a home page to posts. Most sections are purely functional. There is no substantial information for visitors in these pages.

Because sections merely serve as intermediaries to posts, some web programmers set `noindex` meta tag in them for SEO, which is an optional flag in mdcms.

## Posts

Posts or post pages work as real information conveyors in a mdcms site. It is abundant and relevant information that makes content websites great. Good content in such sites benefits SEO as well.

In addition to content in posts, mdcms provides metadata for each post like a title, an author, modified time and an excerpt of a post. These metadata are accessible in its layout.

## Breadcrumbs

Breadcrumbs works as navigation schemes for visitors from current page (either a section or a post) to its home page. Although they are optional and purely functional. Such web widgets benefit SEO as well.

In mdcms, a breadcrumb is an array of links from a home page to current page.

## Table of Contents

A ToC (Table of Contents) serves as an intrapage navigator for a post. Post readers can easily scroll to desired section in a post with this widget.

In mdcms, a ToC composes of dynamically-generated intrapage links to `<h2>`-level titles.

## Sidebars

Sidebars are informative fillers in all pages except posts. There is no fixed rule on what web programmers should put in sidebars. They may be a brief description to a site, promotion campaigns to some products or recommended links to popular posts.

Currently, sidebars in *default* theme of mdcms show concise descriptions of a mdcms site.
