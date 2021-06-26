---
title: Exposed Variables in Layouts
mtime: 2021/6/26
weight: 4
---

## Prologue

Pending.

## Variables Exposed in Home Page

* `$GLOBALS[MDCMS_SECTIONS]`: An array of top sections of a site, which may be an empty array
* `$GLOBALS[MDCMS_POSTS]`: An array of posts without any section of a site, which may be an empty array
* `$GLOBALS[MDCMS_CONTENT]` (not implemented yet):(Optional) HTML content of home page of a site
* `$GLOBALS[MDCMS_BREADCRUMB]`: Breadcrumbs of home page of a site

## Variables Exposed in a Section

* `$GLOBALS[MDCMS_SECTION]`: Current section
* `$GLOBALS[MDCMS_SECTIONS]`: An array of subsections, which may be an empty array
* `$GLOBALS[MDCMS_POSTS]`: An array of posts of current section, which may be an empty array
* `$GLOBALS[MDCMS_BREADCRUMB]`: Breadcrumbs of current section

Fields in `$GLOBALS[MDCMS_SECTION]` (`$section` here):

* `$section[MDCMS_SECTION_TITLE]`: Title of current section
* `$section[MDCMS_SECTION_CONTENT]`: (Optional) HTML content of current section
* `$section[MDCMS_SECTION_META]`: exposed metadata of current section

## Variables Exposed in a Post

* `$GLOBALS[MDCMS_POST]`: Current post
* `$GLOBALS[MDCMS_BREADCRUMB]`: Breadcrumbs of current post

Fields in `$GLOBALS[MDCMS_POST]` (`$post` here):

* `$post[MDCMS_POST_TITLE]`: Title of current post
* `$post[MDCMS_POST_CONTENT]`: HTML content of current post
* `$post[MDCMS_POST_AUTHOR]`: Author of current post
* `$post[MDCMS_POST_MTIME]`: Last modified time of current post
* `$post[MDCMS_POST_META]`: exposed metadata of current post

## Variables in an Element of Subsections of a Section

Fields in an element of subsections of a section (`$section` here):

* `$section[MDCMS_LINK_PATH]`: Link to a section
* `$section[MDCMS_SECTION_TITLE]`: Title of a section
* `$section[MDCMS_SECTION_EXCERPT]`: (Optional) A brief description to a section

## Variables in an Element of Posts of a Section

Fields in an element of posts of a section (`$post` here):

* `$post[MDCMS_LINK_PATH]`: Link to a post
* `$post[MDCMS_POST_TITLE]`: Title of a post
* `$post[MDCMS_POST_EXCERPT]`: A brief description to a post
