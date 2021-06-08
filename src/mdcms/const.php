<?php
namespace mdcms;
# The constants used in mdcms.
#
# Unlike the constants in setting.php, it won't help much to
#  modify these constants. They merely serve as unique symbols
#  in the whole program.


# Site related constants.
define("MDCMS_SECTIONS", "sections");
define("MDCMS_POSTS", "posts");
define("MDCMS_SECTION", "section");
define("MDCMS_POST", "post");


# Section related constants.
define("MDCMS_SECTION_TITLE", "title");
define("MDCMS_SECTION_CONTENT", "content");
define("MDCMS_SECTION_STATUS", "status");
# TODO: Refactor some code.
define("MDCMS_SECTION_MTIME", "mtime");


# Post related constants.
define("MDCMS_POST_TITLE", "title");
define("MDCMS_POST_CONTENT", "content");
define("MDCMS_POST_STATUS", "status");
# TODO: Refactor some code.
define("MDCMS_POST_MTIME", "mtime");
define("MDCMS_POST_WORD_COUNT", "wordCount");
define("MDCMS_POST_EXCERPT", "excerpt");


# Link related constants.
define("MDCMS_LINK_TITLE", "title");
define("MDCMS_LINK_PATH", "path");
# TODO: Remove it later.
define("MDCMS_LINK_MTIME", "mtime");
