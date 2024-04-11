# Google Analytics for Lightweight CMS

## Synopsis

A tiny Lightweight CMS plugin to add a Google Analytics tracker for Lightweight CMS sites.

## System Requirements

* PHP >= 7.2

## Usage

```php
<?php
# Add your Google Analytics tracker adjust to `<head>` tag.

# Fill your Google Analytics id here.
$googleAnalyticsID = "";

if ("" != $googleAnalyticsID) {
    echo \LightweightCMS\Plugin\googleAnalytics($googleAnalyticsID);
}
```

## Breaking Changes

* `2022/03/22`
  * Migrate to Google Analytics 4

## Copyright

Copyright (c) 2021 OpenTechCoder. Licensed under MIT
