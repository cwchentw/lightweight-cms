# Word Count for mdcms

## Synopsis

A tiny mdcms plugin to calculate word count and reading time for western European text.

## System Requirements

* PHP >= 7.2

## Usage

```php
<?php
# In your layout for posts.

$wordCount = \mdcms\Plugin\wordCount($post[MDCMS_POST_CONTENT]);
$readTime = \mdcms\Plugin\readTime($wordCount);
```

## Copyright

Copyright (c) 2021 Michelle Chen. Licensed under MIT
