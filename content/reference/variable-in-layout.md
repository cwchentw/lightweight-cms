---
title: Exposed Variables in Layouts
linkTitle: Layout Variable
mtime: 2023/03/19
weight: 7
---

## Prologue

This article illustrates exposed variables in Lightweight CMS layouts. They are used by Lightweight CMS themes.

## Variables Exposed in Home Page

* `$GLOBALS[LIGHTWEIGHT_CMS_SECTIONS]`: An array of top sections, which may be an empty array
* `$GLOBALS[LIGHTWEIGHT_CMS_POSTS]`: An array of posts without any section, which may be an empty array
* `$GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE]`: (Optional) An array of posts in a page without any section if pagination is on, which may be an empty array
* `$GLOBALS[LIGHTWEIGHT_CMS_CONTENT]`:(Optional) HTML content of home page of a site
* `$GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB]`: Breadcrumbs of home page of a site

## Variables Exposed in a Section

* `$GLOBALS[LIGHTWEIGHT_CMS_SECTION]`: Current section
* `$GLOBALS[LIGHTWEIGHT_CMS_SECTIONS]`: An array of subsections, which may be an empty array
* `$GLOBALS[LIGHTWEIGHT_CMS_POSTS]`: An array of posts of current section, which may be an empty array
* `$GLOBALS[LIGHTWEIGHT_CMS_POST_PER_PAGE]`: (Optional) An array of posts in a page of current section, which may be an empty array
* `$GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB]`: Breadcrumbs of current section

Fields in `$GLOBALS[LIGHTWEIGHT_CMS_SECTION]` (`$section` here):

* `$section[LIGHTWEIGHT_CMS_SECTION_TITLE]`: Title of current section
* `$section[LIGHTWEIGHT_CMS_SECTION_CONTENT]`: (Optional) HTML content of current section
* `$section[LIGHTWEIGHT_CMS_SECTION_META]`: exposed metadata of current section

## Variables Exposed in a Post

* `$GLOBALS[LIGHTWEIGHT_CMS_POST]`: Current post
* `$GLOBALS[LIGHTWEIGHT_CMS_BREADCRUMB]`: Breadcrumbs of current post

Fields in `$GLOBALS[LIGHTWEIGHT_CMS_POST]` (`$post` here):

* `$post[LIGHTWEIGHT_CMS_POST_TITLE]`: Title of current post
* `$post[LIGHTWEIGHT_CMS_POST_CONTENT]`: HTML content of current post
* `$post[LIGHTWEIGHT_CMS_POST_AUTHOR]`: Author of current post
* `$post[LIGHTWEIGHT_CMS_POST_MTIME]`: Last modified time of current post
* `$post[LIGHTWEIGHT_CMS_POST_META]`: exposed metadata of current post

## Variables Exposed in a Page

Same as those in a post.

## Variables in an Element of Subsections of a Section

Fields in an element of subsections of a section (`$section` here):

* `$section[LIGHTWEIGHT_CMS_LINK_PATH]`: Link to a section
* `$section[LIGHTWEIGHT_CMS_SECTION_TITLE]`: Title of a section

## Variables in an Element of Posts of a Section

Fields in an element of posts of a section (`$post` here):

* `$post[LIGHTWEIGHT_CMS_LINK_PATH]`: Link to a post
* `$post[LIGHTWEIGHT_CMS_POST_TITLE]`: Title of a post
