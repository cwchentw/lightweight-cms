---
title: Settings for mdcms
mtime: 2021/6/26
weight: 3
---

## Prologue

Pending.

## Note

mdcms is still experimental and envolving. Those settings may change without warning.

## Project Settings vs Theme Settings

There are two categories settings in mdcms. Project settings are used by mdcms itself while theme settings used by mdcms themes.

You should not remove project settings because either internal library or utility scripts of mdcms rely on those constants to work properly. In contrary, theme settings are optional. Current theme settings are used by *default* theme of mdcms. You may use a different set of theme settings in another mdcms theme.

## Site Information

* `SITE_BASE_URL`: Base URL of a site
* `SITE_NAME`: Full name of a site
* `SITE_SHORT_NAME`: Short name of a site
* `SITE_DESCRIPTION`: A concise description of a site
* `SITE_AUTHOR`: Principle author of a site
* `SITE_COPYRIGHT`: Copyright text of a site
* `SITE_LANGUAGE`: Language code used in a site. Look up a valid language code [here](https://r12a.github.io/app-subtags/)
* `SITE_THEME`: Theme used by a site
* `SITE_LOGO`: File name of site logo without size suffix and file extension. Default file format of site logo is `image/png`

## Social Media

* `FACEBOOK` (theme): Personal Facebook account or Facebook fan page
* `FACEBOOK_GROUP` (theme): Facebook group
* `TWITTER` (theme): Twitter account
* `GITHUB` (theme): Personal GitHub account or a GitHub project

## Site Parameters

* `REDIRECT_LIST` (project): A list of redirecting rules
* `PLUGIN_BLACKLIST` (project): A blacklist to prevent plugin(s) from loading
* `BREADCRUMB_HOME` (theme): Text used by home page on breadcrumbs
* `EXCERPT_THRESHOLD` (project): Text amount for an excerpt of a post

## Optioal Features of mdcms

* `ENABLE_PWA` (theme): Enable PWA (progressive web application) related features
* `ENABLE_TOC` (theme): Enable ToC (table of contents) on sidebars of posts
* `ENABLE_FIXED_SIDEBAR` (theme): Enable fixed sidebars
* `ENABLE_CODE_HIGHTLIGHT` (theme): Enable code highlighting powered by [hightlightjs](https://highlightjs.org/)
* `BLOCK_BOT_ON_SECTION` (theme): Prevent search engine bots from crawling sections
* `NO_FOLLOW_EXTERNAL_LINK` (theme): Prevent search engine bots from following external links
* `LOAD_PERSONAL_ASSETS` (project, deprecated): Enable to load site assets
* `SCAN_APPLICATION_DIRECTORY` (project, deprecated): Scan *www* directory for sections and pages

## Sorting Callbacks

* `$GLOBALS[SORT_SECTION_CALLBACK]` (project): Callback used to sort sections
* `$GLOBALS[SORT_POST_CALLBACK]` (project): Callback used to sort posts

## Internal Parameters

* `SECTION_INDEX` (project): Posts for sections
* `CONTENT_DIRECTORY` (project): Path of *content* directory
* `THEME_DIRECTORY` (project): Path of *themes* directory
* `PLUGIN_DIRECTORY` (project): Path of *plugins* directory
* `ASSET_DIRECTORY` (project): Path of *assets* directory
* `LIBRARY_DIRECTORY` (project): Path of *src* directory
* `APPLICATION_DIRECTORY` (project): Path of *www* directory
* `PUBLIC_DIRECTORY` (project): Path of *public* directory
* `METADATA_TITLE` (project): Field of titles in metadata
* `METADATA_AUTHOR` (project): Field of authors in metadata
* `METADATA_MTIME` (project): Field of last modified time in metadata
* `METADATA_WEIGHT` (project): Field of user-defined values for sorting in metadata
* `HTML_FILE_EXTENSION` (project): File extension used for HTML pages
* `MARKDOWN_FILE_EXTENSION` (project): File extension used for Markdown pages

## Add Your Own Settings

Pending.
