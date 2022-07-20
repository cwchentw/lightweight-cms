# Excerpt for Lightweight CMS

## Synopsis

A tiny Lightweight CMS plugin to generate an excerpt from western European text.

## System Requirements

* PHP >= 7.2

## Usage

```php
<?php
# In your layout for home page and sections.

# Get posts from a global variable.
$posts = $GLOBALS[MDCMS_POSTS];

if (isset($posts) && count($posts) > 0) {
    echo "<h2>Articles</h2>";

    foreach ($posts as $post) {
        echo "<h3>" . $post[MDCMS_POST_TITLE] . "</h3>";

        echo "<p>" . \LightweightCMS\Plugin\excerpt($post[MDCMS_POST_CONTENT]) . " ";

        echo "<a class=\"btn btn-primary btn-sm\" "
            . "href=\"" . $post[MDCMS_LINK_PATH] . "\">"
            . "Read More"
            . "</a>";

        echo "</p>";
    }
}
```

## Copyright

Copyright (c) 2021 Michelle Chen. Licensed under MIT
