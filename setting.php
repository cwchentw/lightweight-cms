<?php
# The project configuration file. Keep its name *as is*.


# Set the name of the website.
define("SITE_NAME", "mdcms");
# Set the short name of the website.
define("SITE_SHORT_NAME", "mdcms");
# Set the description of the website.
define("SITE_DESCRIPTION", "A Markdown-based Content Management System Powered by PHP");
# Set the author of the website.
# Currently, we only support websites of single author.
define("SITE_AUTHOR", "mdcms");
# Set the language of rendered HTML pages.
# Currently, we only support websites of single language.
define("SITE_LANGUAGE", "en-US");
# Set the text of the index page of breadcrumbs.
define("SITE_BREADCRUMB_HOME", "Home");


# These flags will switch on or off optional features.

# Scan application directory.
define("SCAN_APPLICATION_DIRECTORY", false);
# Add supports to PWA (progressive web application).
# You need to make a manifest.json with our ./scripts/manifest script manually.
define("ENABLE_PWA", false);


# Mostly, you don't require to modify anything below.
# If either is modified, modify the project accordingly as well.

# The layout of an index page.
define("HOME_LAYOUT", "home.php");
# The layout of sections.
define("SECTION_LAYOUT", "section.php");
# The layout of posts.
define("POST_LAYOUT", "post.php");

# The index files used by sections.
define("SECTION_INDEX", "_index.md");

# The directory of posts.
define("CONTENT_DIRECTORY", "content");
# The directory of the layouts.
define("LAYOUT_DIRECTORY", "layout");
# The directory of the partials.
define("PARTIALS_DIRECTORY", "partials");
# The directory of the private libraries.
define("LIBRARY_DIRECTORY", "lib");
# The directory of the application.
define("APPLICATION_DIRECTORY", "wwwroot");
# The directory of public files.
define("PUBLIC_DIRECTORY", "public");

# The extension of HTML files.
define("HTML_FILE_EXTENSION", ".html");
# The extension of Markdown files.
define("MARKDOWN_FILE_EXTENSION", ".md");
