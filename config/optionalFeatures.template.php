<?php
# Optional features in a site.


# Style of a site.
# Possible value: blog or documentation.
define("SITE_STYLE", "documentation");
# Enable the supports to PWA (progressive web application).
define("ENABLE_PWA", true);
# Enable a ToC (Table of Contents) on sidebars of posts.
define("ENABLE_TOC", true);
# Enable image lazy loading.
define("ENABLE_IMAGE_LAZY_LOADING", true);
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
define("NO_FOLLOW_EXTERNAL_LINK", true);
# Load personal assets.
define("LOAD_SITE_ASSETS", true);
# Google Analytics tracker.
define("GOOGLE_ANALYTICS_ID", "UA-105146581-5");
