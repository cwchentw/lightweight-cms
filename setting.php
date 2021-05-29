<?php

# Set the name of the website.
define("SITE_NAME", "mdcms Sample Site");
# Set the description of the website.
define("SITE_DESCRIPTION", "A Markdown-based Content Management System Powered by PHP");
# Set the author of the website.
# Currently, we only support websites of single author.
define("SITE_AUTHOR", "mdcms");
# Set the language of rendered HTML pages.
# Currently, we only support websites of single language.
define("SITE_LANGUAGE", "en-US");

# Mostly, you don't require to modify anything below.
# If either is modified, modify the project accordingly as well.

# The layout of index page.
define("INDEX_LAYOUT", "index.php");
# The layout of lists.
define("LIST_LAYOUT", "list.php");
# The layout of posts.
define("POST_LAYOUT", "post.php");

# The directory of the content.
define("CONTENT_DIRECTORY", "content");
# The directory of the layouts.
define("LAYOUT_DIRECTORY", "layout");
# The directory of the partials.
define("PARTIALS_DIRECTORY", "partials");
# The directory of the private libraries.
define("LIBRARY_DIRECTORY", "lib");
# The directory of the application.
define("APPLICATION_DIRECTORY", "wwwroot");

# The extension of HTML files.
define("HTML_FILE_EXTENSION", ".html");
# The extension of Markdown files.
define("MARKDOWN_FILE_EXTENSION", ".md");