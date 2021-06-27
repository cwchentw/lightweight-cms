# Google Analytics for mdcms

## Synopsis

A tiny mdcms plugin to add a Google Analytics tracker for mdcms sites.

## System Requirements

* PHP >= 7.2

## Usage

```php
<?php
# Add your Google Analytics tracker adjust to `<head>` tag.

# Fill your Google Analytics id here.
$googleAnalyticsID = "";

if ("" != $googleAnalyticsID) {
    echo \mdcms\Plugin\googleAnalytics($googleAnalyticsID);
}
```

## Copyright

Copyright (c) 2021 Michelle Chen. Licensed under MIT
