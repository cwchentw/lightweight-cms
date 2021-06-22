<?php
# Parameters of a site.


# Redirecting rules.
define("REDIRECT_LIST", [
    # Default to HTTP status 302.
    ["/hello-world-in-c/", "/sample/c-programming/hello-world/"],
    # Redirecting to an external URL is okey as well.
    ["/google-taiwan/", "https://www.google.com.tw", 301]
]);
# Black list of plugins.
define("PLUGIN_BLACKLIST", []);
# The text of home page on breadcrumbs.
define("BREADCRUMB_HOME", "Index Page");
# The upper limit of the word count of a dynamically generated description.
#
# It should be less than the upper limit of that of a tweet of Twitter.
define("EXCERPT_THRESHOLD", 140);
