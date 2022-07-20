<?php
$post = $GLOBALS[MDCMS_POST];
$section = $GLOBALS[MDCMS_SECTION];

$twitter = TWITTER;

$title = null;
if (!is_null($post) && array_key_exists(MDCMS_POST_TITLE, $post)) {
    $title = $post[MDCMS_POST_TITLE];
}
else if (!is_null($section) && array_key_exists(MDCMS_SECTION_TITLE, $section)) {
    $title = $section[MDCMS_SECTION_TITLE];
}
else {
    $title = SITE_NAME;
}

$description = null;
if (!is_null($post)) {
    $description = \LightweightCMS\Plugin\excerpt($post[MDCMS_POST_CONTENT]);
}
else if (!is_null($section)) {
    $description = \LightweightCMS\Plugin\excerpt($section[MDCMS_SECTION_CONTENT]);
}

if ("" == $description) {
    $description = SITE_DESCRIPTION;
}
?>
<!-- Twitter card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="<?php echo SITE_NAME; ?>">
<?php if ("" != $twitter): ?>
<meta name="twitter:creator" content="<?php echo $twitter; ?>">
<?php endif; ?>
<meta name="twitter:title" content="<?php echo $title; ?>" />
<meta name="twitter:description" content="<?php echo $description; ?>" />
<meta name="twitter:image" content="<?php echo SITE_BASE_URL; ?>/img/<?php echo SITE_LOGO; ?>-128x128.png" />

<!-- Open graph -->
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo SITE_BASE_URL . $_SERVER["REQUEST_URI"]; ?>" />
<meta property="og:locale" content="<?php echo SITE_LANGUAGE; ?>" />
<meta property="og:description" content="<?php echo $description; ?>" />
<meta property="og:image" content="<?php echo SITE_BASE_URL; ?>/img/<?php echo SITE_LOGO; ?>-128x128.png" />
