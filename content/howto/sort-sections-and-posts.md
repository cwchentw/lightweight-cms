---
title: How to Sort Sections and Posts
linkTitle: Sort Sections and Posts
mtime: 2021/6/26
weight: 2
---

## Prologue

mdcms owns builtin algorithms to sort sections and posts. They should be feasible for general conditions. Nevertheless, you may need your own algorithms for sorting of sections and posts. This article illustrates to write your own sorting algorithms.

## How PHP Sorts Stuffs

[usort](https://www.php.net/manual/en/function.usort.php) delegates its sorting algorithm to a callable (callback) fulfilling such interface:

```php
callback(mixed $a, mixed $b): int
```

By this way, users of `usort` function can sort stuffs by their needs without reinventing sorting algorithms.

Lightweight CMS call `usort` internally to sort sections and posts. By modifying sorting callables used by the software, our users can write their sorting routines without altering other Lightweight CMS code.

## Sort Posts

### Common Properties used for Sorting Posts

Here we list common properties of posts used for sorting:

* `title`: title of a post
* `author`: author of a post
* `ctime` (not implemented): created time of a post
* `mtime`: last modified time of a post
* `weight`: a user-defined value for sorting

### Sample Code

Here we show builtin sorting routine used by Lightweight CMS to sort posts:

```php
# Callback to sort posts.
define("SORT_POST_CALLBACK", "sort-post-callback");
$GLOBALS[SORT_POST_CALLBACK] = function ($a, $b) {
    # Sort two posts by their weights.
    if (array_key_exists(LIGHTWEIGHT_CMS_POST_WEIGHT, $a)
        && array_key_exists(LIGHTWEIGHT_CMS_POST_WEIGHT, $b))
    {
        $wa = $a[LIGHTWEIGHT_CMS_POST_WEIGHT];
        $wb = $b[LIGHTWEIGHT_CMS_POST_WEIGHT];

        if ($wa < $wb) {
            return -1;
        }
        else if ($wa == $wb) {
            return 0;
        }
        else {
            return 1;
        }
    }

    # Sort two posts by their modified time.
    #  Your should always set a mtime in metadata
    #  region of posts.
    if (array_key_exists(LIGHTWEIGHT_CMS_POST_MTIME, $a)
        && array_key_exists(LIGHTWEIGHT_CMS_POST_MTIME, $b))
    {
        $ma = $a[LIGHTWEIGHT_CMS_POST_MTIME];
        $mb = $b[LIGHTWEIGHT_CMS_POST_MTIME];

        if ($ma < $mb) {
            return -1;
        }
        else if ($ma == $mb) {
            return 0;
        }
        else {
            return 1;
        }
    }

    # Sort two posts by their titles.
    if (array_key_exists(LIGHTWEIGHT_CMS_POST_TITLE, $a)
        && array_key_exists(LIGHTWEIGHT_CMS_POST_TITLE, $b))
    {
        $ta = $a[LIGHTWEIGHT_CMS_POST_TITLE];
        $tb = $b[LIGHTWEIGHT_CMS_POST_TITLE];

        return strcasecmp($ta, $tb);
    }

    # They are equal, which is seldom the case.
    return 0;
};
```

## Sort Sections

### Common Properties used for Sorting Sections

Here we list common properties of sections for sorting:

* `title`: title of a section
* `ctime` (not implemented): created time of a section
* `mtime`: last modifiled time of a section
* `weight`: a user-defined value for sorting

Sections in Lightweight CMS are merely intermediaries to posts. Authors of sections don't make much sense mostly.

### Sample Code

Here we show builtin sorting routine used by Lightweight CMS to sort sections:

```php
# Callback to sort sections.
define("SORT_SECTION_CALLBACK", "sort-section-callback");
$GLOBALS[SORT_SECTION_CALLBACK] = function ($a, $b) {
    # Sort two sections by their weights.
    if (array_key_exists(LIGHTWEIGHT_CMS_SECTION_WEIGHT, $a)
        && array_key_exists(LIGHTWEIGHT_CMS_SECTION_WEIGHT, $b))
    {
        $wa = $a[LIGHTWEIGHT_CMS_SECTION_WEIGHT];
        $wb = $b[LIGHTWEIGHT_CMS_SECTION_WEIGHT];

        if ($wa < $wb) {
            return -1;
        }
        else if ($wa == $wb) {
            return 0;
        }
        else {
            return 1;
        }
    }

    # Sort two sections by their titles.
    if (array_key_exists(LIGHTWEIGHT_CMS_SECTION_TITLE, $a)
        && array_key_exists(LIGHTWEIGHT_CMS_SECTION_TITLE, $b))
    {
        $ta = $a[LIGHTWEIGHT_CMS_SECTION_TITLE];
        $tb = $b[LIGHTWEIGHT_CMS_SECTION_TITLE];

        return strcasecmp($ta, $tb);
    }

    # They are equal, which is seldom the case.
    return 0;
};
```
