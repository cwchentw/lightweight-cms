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
#  set the author of a specific post in its front matter.
define("SITE_AUTHOR", "mdcms");
# The language of rendered HTML pages.
#
# mdcms is not designed for a multi-language site.
#  You may require two or more sets of layouts and
#  some modifications on the router of mdcms for such site.
define("SITE_LANGUAGE", "en-US");
# The theme of a site.
define("SITE_THEME", "default");
# The text of the home page on breadcrumbs.
define("SITE_BREADCRUMB_HOME", "Home");


# The parameters of a site.

# The upper limit of the word count of a dynamically generated description.
#
# It should be less than the upper limit of that of a tweet of Twitter.
define("EXCERPT_THRESHOLD", 140);


# These flags will switch on or off optional features.

# Enable the supports to PWA (progressive web application).
define("ENABLE_PWA", true);
# Enable a ToC (Table of Contents) on the sidebar of posts.
define("ENABLE_TOC", true);
# Enable a fixed sidebar.
define("ENABLE_FIXED_SIDEBAR", true);
# Enable the support to hightlight.js
# Currently, the theme of hightlight.js is hard coded.
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
# If either is modified, modify the project accordingly as well.

# The index files used by sections.
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

# The extension of HTML files.
define("HTML_FILE_EXTENSION", ".html");
# The extension of Markdown files.
define("MARKDOWN_FILE_EXTENSION", ".md");
