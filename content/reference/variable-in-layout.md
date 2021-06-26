---
title: Exposed Variables in Layouts
mtime: 2021/6/26
weight: 4
---

## Prologue

## Variables Exposed in Home Page

* `$GLOBALS[MDCMS_SECTIONS]`: An array of top sections of a mdcms site
* `$GLOBALS[MDCMS_POSTS]`: An array of posts without any section of a mdcms site
* `$GLOBALS[MDCMS_CONTENT]` (not implemented yet): A string of optional content of home page of a mdcms site
* `$GLOBALS[MDCMS_BREADCRUMB]`: Breadcrumbs of home page of a mdcms site

## Variables Exposed in a Section

* `$GLOBALS[MDCMS_SECTION]`: Current section
* `$GLOBALS[MDCMS_SECTIONS]`: An array of subsections
* `$GLOBALS[MDCMS_POSTS]`: An array of posts of current section
* `$GLOBALS[MDCMS_BREADCRUMB]`: Breadcrumbs of current section

## Variables Exposed in a Post

* `$GLOBALS[MDCMS_POST]`: Current post
* `$GLOBALS[MDCMS_BREADCRUMB]`: Breadcrumbs of current post

Fields in `$GLOBALS[MDCMS_POST]` (`$post` here):

* `$post[MDCMS_POST_TITLE]`: Title of current post
* `$post[MDCMS_POST_CONTENT]`: HTML content of current post
* `$post[MDCMS_POST_AUTHOR]`: Author of current post
* `$post[MDCMS_POST_MTIME]`: Last modified time of current post
* `$post[MDCMS_POST_META]` (not implemented yet): exposed metadata of current post

## Variables in an Element of Sections

* `$section[MDCMS_LINK_PATH]`: Link to a section
* `$section[MDCMS_SECTION_TITLE]`: Title of a section
* `$section[MDCMS_SECTION_EXCERPT]`: A brief description to a section

## Variables in an Element of Posts

* `$post[MDCMS_LINK_PATH]`: Link to a post
* `$post[MDCMS_POST_TITLE]`: Title of a post
* `$post[MDCMS_POST_EXCERPT]`: A brief description to a post
