<?php
namespace LightweightCMS\Core;

# Constants used in mdcms.
#
# Unlike the constants in setting.php, it won't help much to
#  modify these constants. They merely serve as unique symbols
#  in the whole program.


# Site related constants.
define("LIGHTWEIGHT_CMS_SECTIONS", "sections");
define("LIGHTWEIGHT_CMS_POSTS", "posts");
define("LIGHTWEIGHT_CMS_POST_PER_PAGE", "post-per-page");


# Page related constants.
define("LIGHTWEIGHT_CMS_SECTION", "section");
define("LIGHTWEIGHT_CMS_POST", "post");
define("LIGHTWEIGHT_CMS_BREADCRUMB", "breadcrumb");


# Section related constants.
define("LIGHTWEIGHT_CMS_SECTION_TITLE", "title");
define("LIGHTWEIGHT_CMS_SECTION_AUTHOR", "author");
define("LIGHTWEIGHT_CMS_SECTION_MTIME", "mtime");
define("LIGHTWEIGHT_CMS_SECTION_WEIGHT", "weight");
define("LIGHTWEIGHT_CMS_SECTION_META", "meta");
define("LIGHTWEIGHT_CMS_SECTION_CONTENT", "content");
define("LIGHTWEIGHT_CMS_SECTION_STATUS", "status");


# Post related constants.
define("LIGHTWEIGHT_CMS_POST_TITLE", "title");
define("LIGHTWEIGHT_CMS_POST_AUTHOR", "author");
define("LIGHTWEIGHT_CMS_POST_MTIME", "mtime");
define("LIGHTWEIGHT_CMS_POST_WEIGHT", "weight");
define("LIGHTWEIGHT_CMS_POST_TAGS", "tags");
define("LIGHTWEIGHT_CMS_POST_META", "meta");
define("LIGHTWEIGHT_CMS_POST_CONTENT", "content");
define("LIGHTWEIGHT_CMS_POST_STATUS", "status");


# Link related constants.
define("LIGHTWEIGHT_CMS_LINK_TITLE", "title");
define("LIGHTWEIGHT_CMS_LINK_PATH", "path");
define("LIGHTWEIGHT_CMS_LINK_MTIME", "mtime");
