# Word Count for Lightweight CMS

## Synopsis

A tiny Lightweight CMS plugin to calculate word count and reading time for western European text.

## System Requirements

* PHP >= 7.2

## Usage

```php
<?php
# In your layout for posts.

$wordCount = \LightweightCMS\Plugin\wordCount($post[LIGHTWEIGHT_CMS_POST_CONTENT]);
$readTime = \LightweightCMS\Plugin\readTime($wordCount);
```

## Copyright

Copyright (c) 2021 Michelle Chen. Licensed under MIT
