---
title: How to Sort Sections and Posts
mtime: 2021/6/26
---

## Prologue

mdcms owns builtin algorithms to sort sections and posts. They should be feasible for general conditions. Nevertheless, you may need your own algorithms for sorting of sections and posts. This article illustrates to write your own sorting algorithms.

## Sort Posts

### Common Properties used for Sorting Posts

* `title`
* `author`
* `mtime`
* `weight`

### Sample Code

```php
# Callback to sort posts.
define("SORT_POST_CALLBACK", "sort-post-callback");
$GLOBALS[SORT_POST_CALLBACK] = function ($a, $b) {
    # Sort two posts by their weights.
    if (array_key_exists(MDCMS_POST_WEIGHT, $a)
        && array_key_exists(MDCMS_POST_WEIGHT, $b))
    {
        $wa = $a[MDCMS_POST_WEIGHT];
        $wb = $b[MDCMS_POST_WEIGHT];

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
    if (array_key_exists(MDCMS_POST_MTIME, $a)
        && array_key_exists(MDCMS_POST_MTIME, $b))
    {
        $ma = $a[MDCMS_POST_MTIME];
        $mb = $b[MDCMS_POST_MTIME];

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
    if (array_key_exists(MDCMS_POST_TITLE, $a)
        && array_key_exists(MDCMS_POST_TITLE, $b))
    {
        $ta = $a[MDCMS_POST_TITLE];
        $tb = $b[MDCMS_POST_TITLE];

        return strcasecmp($ta, $tb);
    }

    # They are equal, which is seldom the case.
    return 0;
};
```

## Sort Sections

### Common Properties used for Sorting Sections

* `title`
* `mtime`
* `weight`

### Sample Code

```php
# Callback to sort sections.
define("SORT_SECTION_CALLBACK", "sort-section-callback");
$GLOBALS[SORT_SECTION_CALLBACK] = function ($a, $b) {
    # Sort two sections by their weights.
    if (array_key_exists(MDCMS_SECTION_WEIGHT, $a)
        && array_key_exists(MDCMS_SECTION_WEIGHT, $b))
    {
        $wa = $a[MDCMS_SECTION_WEIGHT];
        $wb = $b[MDCMS_SECTION_WEIGHT];

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
    if (array_key_exists(MDCMS_SECTION_TITLE, $a)
        && array_key_exists(MDCMS_SECTION_TITLE, $b))
    {
        $ta = $a[MDCMS_SECTION_TITLE];
        $tb = $b[MDCMS_SECTION_TITLE];

        return strcasecmp($ta, $tb);
    }

    # They are equal, which is seldom the case.
    return 0;
};
```
