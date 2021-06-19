<?php
# Project configuration file. Keep its name *as is*.


# Information of a site.

# Base URL of a site without a trailing slash.
define("SITE_BASE_URL", "https://example.com");
# Full name of a site.
define("SITE_NAME", "Markdown Content Management System");
# Short name of a site.
define("SITE_SHORT_NAME", "mdcms");
# A concise description of a site.
define("SITE_DESCRIPTION", "A Markdown-based Dynamic Website Generator Powered by PHP");
# Principal author of a site.
#
# If there are multiple authors in a site,
#  set the author of a specific post in its front matter.
define("SITE_AUTHOR", "Michelle Chen");
# Copyright text of a site.
define("SITE_COPYRIGHT", "Copyright (c) 2021 Michelle Chen. Licensed under CC BY 4.0.");
# Language of rendered HTML pages.
#
# mdcms is not designed for a multi-language site.
#  You may require two or more sets of layouts and
#  some modifications on router of mdcms for such a site.
define("SITE_LANGUAGE", "en-US");
# Theme of a site.
define("SITE_THEME", "default");



# Social media for a site.

# Facebook account or Facebook fan page.
define("FACEBOOK", "");
# Facebook group.
define("FACEBOOK_GROUP", "");
# Twitter account.
define("TWITTER", "");
# GitHub user or project.
#
# If it is a project, it should be in the form of `user/project`.
#  In contrary, if it is a user, it should be the user name.
define("GITHUB", "cwchentw/mdcms");


# Parameters of a site.

# The text of home page on breadcrumbs.
define("BREADCRUMB_HOME", "Index Page");
# The upper limit of the word count of a dynamically generated description.
#
# It should be less than the upper limit of that of a tweet of Twitter.
define("EXCERPT_THRESHOLD", 140);


# Optional features in a site.

# Enable the supports to PWA (progressive web application).
define("ENABLE_PWA", true);
# Enable a ToC (Table of Contents) on sidebars of posts.
define("ENABLE_TOC", true);
# Enable fixed sidebars.
define("ENABLE_FIXED_SIDEBAR", true);
# Enable the support to hightlight.js
#  Currently, the theme of hightlight.js is hard coded.
define("ENABLE_CODE_HIGHTLIGHT", true);
# Block search engine bots on sections.
#
# Such action is optional but recommended for SEO.
define("BLOCK_BOT_ON_SECTION", true);
# Prevent search engine bots from following external sites.
#
# Such actions are merely for SEO. Not good for a health Web.
# FIXME: Some links fails to change.
define("NO_FOLLOW_EXTERNAL_LINK", true);
# Scan application directory.
#
# By default, mdcms only scans sections and posts
#  in the content directory.
define("SCAN_APPLICATION_DIRECTORY", false);


# Mostly, you don't require to modify anything below.
# If either is modified, change your project accordingly as well.

# The index files used by home page and sections.
define("SECTION_INDEX", "_index.md");

# The directory of sections and posts.
define("CONTENT_DIRECTORY", "content");
# The directory of themes.
define("THEME_DIRECTORY", "themes");
# The directory of plugins.
define("PLUGIN_DIRECTORY", "plugins");
# The directory of the internal libraries of mdcms.
define("LIBRARY_DIRECTORY", "src");
# The directory of the web application.
define("APPLICATION_DIRECTORY", "www");
# The directory of public files.
define("PUBLIC_DIRECTORY", "public");

# Title of a section or a post.
define("METADATA_TITLE", "title");
# Author of a post.
define("METADATA_AUTHOR", "author");
# mtime (last modified time) of a post.
define("METADATA_MTIME", "mtime");
# Weight of a post.
define("METADATA_WEIGHT", "weight");

# The extension of HTML files.
define("HTML_FILE_EXTENSION", ".html");
# The extension of Markdown files.
define("MARKDOWN_FILE_EXTENSION", ".md");

# Callback to sort posts.
define("SORT_POST_CALLBACK", "sort-post-callback");
$GLOBALS[SORT_POST_CALLBACK] = function ($a, $b) {
    if (array_key_exists(MDCMS_POST_WEIGHT, $a)
        && array_key_exists(MDCMS_POST_WEIGHT, $b))
    {
        $wa = $a[MDCMS_POST_WEIGHT];
        $wb = $b[MDCMS_POST_WEIGHT];

        if ($wa < $wb) {
            return -1;
        }
        else if ($wa == $wb) {
            return 0;
        }
        else {
            return 1;
        }
    }

    if (array_key_exists(MDCMS_POST_MTIME, $a)
        && array_key_exists(MDCMS_POST_MTIME, $b))
    {
        $ma = $a[MDCMS_POST_MTIME];
        $mb = $b[MDCMS_POST_MTIME];

        if ($ma < $mb) {
            return -1;
        }
        else if ($ma == $mb) {
            return 0;
        }
        else {
            return 1;
        }
    }

    if (array_key_exists(MDCMS_POST_TITLE, $a)
        && array_key_exists(MDCMS_POST_TITLE, $b))
    {
        $ta = $a[MDCMS_POST_TITLE];
        $tb = $b[MDCMS_POST_TITLE];

        return strcasecmp($ta, $tb);
    }

    return 0;
};
