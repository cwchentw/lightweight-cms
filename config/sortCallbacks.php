<?php
# Sort callbacks for a site.


# Callback to sort sections.
define("SORT_SECTION_CALLBACK", "sort-section-callback");
$GLOBALS[SORT_SECTION_CALLBACK] = function ($a, $b) {
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

    if (array_key_exists(MDCMS_SECTION_TITLE, $a)
        && array_key_exists(MDCMS_SECTION_TITLE, $b))
    {
        $ta = $a[MDCMS_SECTION_TITLE];
        $tb = $b[MDCMS_SECTION_TITLE];

        return strcasecmp($ta, $tb);
    }

    return 0;
};

# Callback to sort posts.
define("SORT_POST_CALLBACK", "sort-post-callback");
$GLOBALS[SORT_POST_CALLBACK] = function ($a, $b) {
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

    if (array_key_exists(MDCMS_POST_TITLE, $a)
        && array_key_exists(MDCMS_POST_TITLE, $b))
    {
        $ta = $a[MDCMS_POST_TITLE];
        $tb = $b[MDCMS_POST_TITLE];

        return strcasecmp($ta, $tb);
    }

    return 0;
};
