---
title: Lightweight CMS 的概念
linkTitle: 概念
mtime: 2022/09/11
weight: 1
---

## 概要

Lightweight CMS stands for a flat-file CMS powered by PHP. The software bridges between incoming URLs and corresponding directories or files on a web server. Because the contents on Lightweight CMS sites are stored in flat files, there is no relational database involved in such sites.

This article illustrates the concepts related to Lightweight CMS.

## 路由

A **router** is the hub of a Lightweight CMS site. It receives **requests** from a web server (Apache, Nginx or anything else), maps a URL to a corresponding directory or a post file and sends **responses** back to the server.

The router of a Lightweight CMS site is implemented in [www/index.php](https://github.com/cwchentw/lightweight-cms/blob/master/www/index.php). Users of our software seldom require to edit the script by themselves.

## 頁面

### 首頁

`https://example.com`

A **home page** in a Lightweight CMS site is an unique web page that deserves a dedicated layout. This page emanates general impression about a site and directs users to desired information ideally.

Web programmers arrange layout of a home page differently from that of section pages mostly. Therefore, their layouts are separated in Lightweight CMS.

### 章節

`https://example.com/section/`

Sections or section pages in a Lightweight CMS site are in-between pages from a home page to posts. Most sections are purely functional. There is no substantial information for visitors in these pages.

Because sections merely serve as intermediaries to posts, they seldom benefit site SEO. Some web programmers set `noindex` meta tag in them to reduce SEO penalties, which is an optional feature in Lightweight CMS.

### 文章

`https://example.com/section/post/`

Posts or post pages work as real information conveyors in a Lightweight CMS site. It is abundant and relevant information that makes content websites great. Good content in such sites benefits SEO as well.

In addition to content in posts, Lightweight CMS provides metadata for each post like a title, an author and last modified time. These metadata are accessible in its layout.

### 客製頁面

`https://example.com/section/custom-page/`

Sometimes Lightweight CMS users require to create custom pages with layouts different from those of home page, sections and posts. In Lightweight CMS, custom pages are PHP scripts in *content* directory.

Because custom pages in a Lightweight CMS site don't rely on layouts from a Lightweight CMS theme, users have to arrange layouts in those pages by themselves.

*TODO: Use the partials in a Lightweight CMS theme*

### 錯誤頁面

Error pages only show when some errors occur. Common errors include **HTTP 404** (page not found) and **HTTP 50x** (internal server error). Web programmers should not rely on the builtin error pages provided by web servers because sensitive server information is leaked in those pages.

In Lightweight CMS, HTTP 404 pages are both generated dynamically and compiled in advance when your site users visit some non-existing pages on a Lightweight CMS site. In contrary, HTTP 50x pages are always static because PHP may fail to render web pages properly in such situations.

## 元件

Widgets in web pages are purely conceptual, which are HTML elements with different styling under the hood. Here we introduce the widgets seen in *default* theme of Lightweight CMS.

### 導覽列

Navbars in a website let site visitors navigate through a site. They are thin horizontal widgets placed at the top of web pages mostly, may be sticky or not. Ideal navbars direct site users to relevant pages within smoothly.

### 頁尾

As the name implies, footers are placed at the bottom of web pages, which provide site information like a copyright text, terms and conditions, privacy policy, links to social media and hiring announcement. It would be better to consider footers functional and optional information widgets.

### 頁面路徑

Breadcrumbs work as navigation schemes for site visitors from current pages (either sections or posts) to home pages hierarchically. Although those web widgets are optional and purely functional, they benefit SEO as well.

In Lightweight CMS, a breadcrumb of a page is an array of links from a home page to current page.

### 分頁

Pagination means to scale posts by splitting posts into multiple section pages. With pagination, there won't be too many links to posts, which is bad to SEO.

*Default* theme of mdmcs utilizes pagination in Bootstrap 5.

### 目錄 Table of Contents

A ToC (Table of Contents) serves as an intrapage navigator for a post. Post readers can easily scroll to desired section in a post with this widget.

In Lightweight CMS, a ToC composes of dynamically-generated intrapage links to `<h2>`-level titles.

### 側邊欄

Sidebars are informative fillers in all pages except posts. There is no fixed rule on what web programmers should put in sidebars. They may be a brief description to a site, promotion campaigns to some products or recommended links to popular posts.

Currently, sidebars in *default* theme of Lightweight CMS show concise descriptions to a Lightweight CMS site.

## 佈景主題

A theme composes of a set of layouts used by a Lightweight CMS site to render web pages. By utilizing themes in Lightweight CMS sites, web programmers save time to write each page manually and Lightweight CMS sites own consistent looking among pages.

## 靜態資產

Assets are stuffs used in front end like CSS sheets, JavaScript scripts, fonts, images and audios. There are dozens of front end languages to improve original front end technologies. Lightweight CMS adapts SCSS and Babel because these languages are compatible with CSS and JavaScript.

## 總結

This article illustrates concepts to Lightweight CMS. If you are unfamiliar to web programming, this page may give you a mind roadmap to both Lightweight CMS and content websites in general.

Here list [the features](/reference/feature/) of Lightweight CMS.
