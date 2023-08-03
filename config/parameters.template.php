<?php
# Parameters of a site.


# Style of a site.
# Possible value: blog or documentation.
define("SITE_STYLE", "documentation");
# Redirecting rules.
define(
    "REDIRECT_LIST",
    [
        # Default to HTTP status 302.
        ["/hello-world-in-c/", "/sample/c-programming/hello-world/"],
        # Redirecting to an external URL is okey as well.
        ["/google-taiwan/", "https://www.google.com.tw", 301]
    ]
);
# Black list of plugins.
define("PLUGIN_BLACKLIST", []);
# Post amount per page (home page and sections).
#
# To disable pagination, set it to `0`.
define("POST_PER_PAGE", 5);
# The text of home page on breadcrumbs.
define("BREADCRUMB_HOME", "Lightweight CMS");
# The upper limit of the word count of a dynamically generated description.
#
# It should be less than the upper limit of that of a tweet of Twitter.
define("EXCERPT_THRESHOLD", 140);
# The theme color.
define("THEME_COLOR", "#578583");
# The script direction. Scripts in most languages are ltr (left-to-right).
define("SCRIPT_DIRECTION", "ltr");
# The orientation of a website or a web application.
define("SITE_ORIENTATION", "portrait-primary");
