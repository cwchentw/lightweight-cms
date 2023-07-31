<?php
$post = $GLOBALS[LIGHTWEIGHT_CMS_POST];
if (array_key_exists(LIGHTWEIGHT_CMS_POST_META, $post)
    && array_key_exists(LIGHTWEIGHT_CMS_POST_TAGS, $post[LIGHTWEIGHT_CMS_POST_META]))
{
    $tags = $post[LIGHTWEIGHT_CMS_POST_META][LIGHTWEIGHT_CMS_POST_TAGS];
}
else {
    $tags = array();  # A dummy array as no tag.
}
?>
<div style='margin-bottom: 5px;'>
<?php
foreach ($tags as $tag) {
    echo "<a href='/tags/" . preg_replace("/_/", "%20", urlencode(preg_replace("/ /", "_", $tag))) . "/'"
        . " class='badge bg-primary' style='margin-right: 3px; margin-bottom: 5px;'>"
        . $tag . "</a>";
}
?>
</div>