<?php
# The project configuration file. Keep its name *as is*.


# The information of a site.

# The base URL of a site without a trailing slash.
define("SITE_BASE_URL", "https://example.com");
# The full name of a site.
define("SITE_NAME", "mdcms (Markdown Content Management System)");
# The short name of a site.
define("SITE_SHORT_NAME", "mdcms");
# A concise description of a site.
define("SITE_DESCRIPTION", "A Markdown-based Dynamic Website Generator Powered by PHP");
# The principal author of a site.
#
# If there are multiple authors in a site,
#  set the author of a specific post in its metadata.
define("SITE_AUTHOR", "mdcms");
# The language of rendered HTML pages.
#
# mdcms is not designed for a multi-language site.
#  You may require two or more sets of layouts and
#  some modifications on the router of mdcms for such site.
define("SITE_LANGUAGE", "en-US");
# The text of the home page on breadcrumbs.
define("SITE_BREADCRUMB_HOME", "Home");


# The parameters of a site.

# The upper limit of word count of excerpts.
# It should be less than the upper limit of a tweet of Twitter.
define("EXCERPT_THRESHOLD", 240);


# These flags will switch on or off optional features.

# Enable the supports to PWA (progressive web application).
define("ENABLE_PWA", false);
# Enable ToC (Table of Contents).
define("ENABLE_TOC", false);
# Enable fixed sidebar.
define("ENABLE_FIXED_SIDEBAR", false);
# Enable the support to hightlight.js
# Currently, the theme of hightlight.js is hard coded.
define("ENABLE_CODE_HIGHTLIGHT", false);
# Block search engine bots on sections.
#
# Such action is optional but recommended for SEO.
define("BLOCK_BOT", false);
# Scan application directory.
#
# By default, mdcms only scans sections and posts
#  in the content directory.
define("SCAN_APPLICATION_DIRECTORY", false);


# Mostly, you don't require to modify anything below.
# If either is modified, modify the project accordingly as well.

# The layout of an index page.
define("HOME_LAYOUT", "home.php");
# The layout of sections.
define("SECTION_LAYOUT", "section.php");
# The layout of posts.
define("POST_LAYOUT", "post.php");
# The layout of manifest.json
define("MANIFEST_LAYOUT", "manifest.php");
# The layout of sitemap.xml
define("SITEMAP_LAYOUT", "sitemap.php");

# The index files used by sections.
define("SECTION_INDEX", "_index.md");

# The directory of sections and posts.
define("CONTENT_DIRECTORY", "content");
# The directory of the layouts.
define("LAYOUT_DIRECTORY", "layout");
# The directory of the partials.
define("PARTIALS_DIRECTORY", "partials");
# The directory of the internal libraries of mdcms.
define("LIBRARY_DIRECTORY", "src");
# The directory of the web application.
define("APPLICATION_DIRECTORY", "wwwroot");
# The directory of public files.
define("PUBLIC_DIRECTORY", "public");

# The extension of HTML files.
define("HTML_FILE_EXTENSION", ".html");
# The extension of Markdown files.
define("MARKDOWN_FILE_EXTENSION", ".md");
