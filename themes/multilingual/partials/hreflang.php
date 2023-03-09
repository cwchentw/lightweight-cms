<?php
$baseURI = baseURI();
$zhTW_URI = "/zh-tw" . $baseURI;
$enUS_URI = "/en-us" . $baseURI;
?>


<?php if (\LightweightCMS\Core\issection($zhTW_URI)
          || (POST_PER_PAGE > 0 && \LightweightCMS\Core\isPageInSection($zhTW_URI))
          || \LightweightCMS\Core\isPage($zhTW_URI)
          || \LightweightCMS\Core\isPost($zhTW_URI)): ?>
<link rel="alternate" hreflang="zh-tw" href="<?php echo SITE_BASE_URL . $zhTW_URI ?>" />
<?php endif; ?>
<?php if (\LightweightCMS\Core\issection($enUS_URI)
          || (POST_PER_PAGE > 0 && \LightweightCMS\Core\isPageInSection($enUS_URI))
          || \LightweightCMS\Core\isPage($enUS_URI)
          || \LightweightCMS\Core\isPost($enUS_URI)): ?>
<link rel="alternate" hreflang="en-us" href="<?php echo SITE_BASE_URL . $enUS_URI; ?>" />
<?php endif; ?>
<?php if (\LightweightCMS\Core\issection($baseURI)
          || (POST_PER_PAGE > 0 && \LightweightCMS\Core\isPageInSection($baseURI))
          || \LightweightCMS\Core\isPage($baseURI)
          || \LightweightCMS\Core\isPost($baseURI)): ?>
<link rel="alternate" hreflang="x-default" href="<?php echo SITE_BASE_URL . $baseURI; ?>" />
<?php endif; ?>
