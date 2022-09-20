---
title: 專案設置
linkTitle: 設置
mtime: 2022/09/11
weight: 6
---

## 前言

Settings in Lightweight CMS work as parameters to modify Lightweight CMS sites. This article illustrates those settings.

## 不同類別的設置

There are three categories of settings in Lightweight CMS. **Project setting**s are used by Lightweight CMS itself, **theme setting**s used by Lightweight CMS themes and **plugin setting**s used by Lightweight CMS plugins.

You should not remove project settings because either internal library or utility scripts of Lightweight CMS rely on those constants to work properly. In contrary, theme settings and plugin settings are optional. Current theme settings are used by *default* theme of Lightweight CMS. You may use a different set of theme settings in another Lightweight CMS theme.

## 站台資訊

* `SITE_BASE_URL` (project): The base URL of a site
* `SITE_PREFIX` (project): The prefix of a site. Used for a subsite.
* `SITE_NAME` (project): The full name of a site
* `SITE_SHORT_NAME` (project): The short name of a site
* `SITE_DESCRIPTION` (project): A concise description of a site
* `SITE_AUTHOR` (project): The principle author of a site
* `SITE_COPYRIGHT` (theme): The copyright text of a site
* `SITE_LANGUAGE` (project): The language code used in a site. Look up a valid language code [here](https://github.com/libyal/libfwnt/wiki/Language-Code-identifiers#language-identifiers)
* `SITE_THEME` (project): Theme used by a site
* `SITE_LOGO` (project): File name of site logo without size suffix and file extension. Default file format of site logo is `image/png`

`SITE_AUTHOR` is default author of a Lightweight CMS site. You may set a author of a post other than `SITE_AUTHOR` in its metadata.

## 社群媒體

* `FACEBOOK` (theme): Personal Facebook account or Facebook fan page
* `FACEBOOK_GROUP` (theme): Facebook group
* `TWITTER` (theme): Twitter account
* `GITHUB` (theme): Personal GitHub account or a GitHub project

## 站台參數

* `REDIRECT_LIST` (project): A list of redirecting rules
* `PLUGIN_BLACKLIST` (project): A blacklist to prevent plugin(s) from loading
* `BREADCRUMB_HOME` (project): Text used by home page on breadcrumbs
* `EXCERPT_THRESHOLD` (plugin): Text amount for an excerpt of a post
* `THEME_COLOR` (theme): `theme-color` in `<meta>` tag
* `SCRIPT_DIRECTION` (project): the script direction of the main language of your site
* `SITE_ORIENTATION` (project): the orientation of a site or a web application

## 可選擇特性

* `ENABLE_PWA` (theme): Enable PWA (progressive web application) related features
* `ENABLE_TOC` (theme): Enable ToC (table of contents) on sidebars of posts
* `ENABLE_FIXED_SIDEBAR` (theme): Enable fixed sidebars
* `ENABLE_CODE_HIGHTLIGHT` (theme): Enable code highlighting powered by [hightlightjs](https://highlightjs.org/)
* `BLOCK_BOT_ON_SECTION` (theme): Prevent search engine bots from crawling sections
* `NO_FOLLOW_EXTERNAL_LINK` (project): Prevent search engine bots from following external links
* `LOAD_SITE_ASSETS` (project): Enable to load site assets
* `GOOGLE_ANALYTICS_ID` (plugin): Set the id of Google Analytics 4

## 排序回呼函式

* `$GLOBALS[SORT_SECTION_CALLBACK]` (project): Callback used to sort sections
* `$GLOBALS[SORT_POST_CALLBACK]` (project): Callback used to sort posts

See [this article](/howto/how-to-sort-sections-and-posts/) for information on writing sorting callbacks for sections and posts.

## 內部參數

Lightweight CMS is flexible by design. Although these internal settings are seldom modified by end users, you may modify them to fit your own need.

### 章節用文件檔

* `SECTION_INDEX` (project): Posts for sections

### 專案結構

* `CONTENT_DIRECTORY` (project): Path of *content* directory
* `THEME_DIRECTORY` (project): Path of *themes* directory
* `PLUGIN_DIRECTORY` (project): Path of *plugins* directory
* `ASSET_DIRECTORY` (project): Path of *assets* directory
* `LIBRARY_DIRECTORY` (project): Path of *src* directory
* `APPLICATION_DIRECTORY` (project): Path of *www* directory
* `PUBLIC_DIRECTORY` (project): Path of *public* directory

### 章節和文章的元資料

* `METADATA_TITLE` (project): The field of titles in metadata
* `METADATA_AUTHOR` (project): The Field of authors in metadata
* `METADATA_MTIME` (project): The field of last modified time in metadata
* `METADATA_WEIGHT` (project): The field of user-defined values for sorting in metadata
* `METADATA_NOINDEX` (project): The field to prevent search engine bots from crawling
* `METADATA_DRAFT` (project): The field to set the status of a post as a draft

### 文檔的副檔名

* `HTML_FILE_EXTENSION` (project): The file extension used for HTML posts
* `MARKDOWN_FILE_EXTENSION` (project): The file extension used for Markdown posts
* `ASCIIDOC_FILE_EXTENSION` (project): The file extension used for AsciiDoc posts
* `RESTRUCTUREDTEXT_FILE_EXTENSION` (project): The file extension used for reStructuredText posts

## 自行新增特性

In addition to current settings used by Lightweight CMS, you may add you own as needed.
