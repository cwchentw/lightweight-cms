<?php
$baseURL = SITE_BASE_URL;
$relURL = $_SERVER['REQUEST_URI'];
$url = $baseURL . $relURL;
$title = urldecode(SITE_NAME);
$summary = urlencode(SITE_DESCRIPTION);
$twitter = TWITTER;
$width = "32";
?>

<div style='margin-bottom: 10px;'>
    <a class="img-link"
       href='https://www.facebook.com/sharer.php?u=<?php echo $url; ?>'>
        <img src="<?php echo SITE_PREFIX; ?>/img/share-buttons/facebook-32x32.png" alt="Facebook">
    </a>
    <a class="img-link"
       href='https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>&via=<?php echo $twitter; ?>'>
        <source type="image/webp" srcset="<?php echo SITE_PREFIX; ?>/img/share-buttons/twitter-48x48.webp" width="<?php echo $width; ?>">
        <source type="image/png" srcset="<?php echo SITE_PREFIX; ?>/img/share-buttons/twitter-48x48.png" width="<?php echo $width; ?>">
        <img src="<?php echo SITE_PREFIX; ?>/img/share-buttons/twitter-32x32.png" alt="Twitter">
    </a>
    <a class="img-link"
       href='https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>&summary=<?php echo $summary; ?>&source=<?php echo $title; ?>'>
        <img src="<?php echo SITE_PREFIX; ?>/img/share-buttons/linkedin-32x32.png" alt="LinkedIn">
    </a>
    <a class="img-link"
       href='https://lineit.line.me/share/ui?url=<?php echo $url; ?>&text=<?php echo $title; ?>'>
        <source type="image/webp" srcset="<?php echo SITE_PREFIX; ?>/img/share-buttons/line.me-48x48.webp" width="<?php echo $width; ?>">
        <source type="image/png" srcset="<?php echo SITE_PREFIX; ?>/img/share-buttons/line.me-48x48.png" width="<?php echo $width; ?>">
        <img src="<?php echo SITE_PREFIX; ?>/img/share-buttons/line.me-32x32.png" alt="LINE">
    </a>
    <a class="img-link"
       href='https://web.skype.com/share?url=<?php echo $url; ?>&text=<?php echo $title; ?>'>
        <img src="<?php echo SITE_PREFIX; ?>/img/share-buttons/skype-32x32.png" alt="Skype">
    </a>
    <a class="img-link"
       href='http://www.evernote.com/clip.action?url=<?php echo $url; ?>&title=<?php echo $title; ?>'>
        <img src="<?php echo SITE_PREFIX; ?>/img/share-buttons/evernote-32x32.png" alt="EverNote">
    </a>
    <a class="img-link"
       href='https://mail.google.com/mail/?view=cm&to=&su=<?php echo $title; ?>&body=<?php echo $url; ?>'>
        <source type="image/webp" srcset="<?php echo SITE_PREFIX; ?>/img/share-buttons/gmail-48x48.webp" width="<?php echo $width; ?>">
        <source type="image/png" srcset="<?php echo SITE_PREFIX; ?>/img/share-buttons/gmail-48x48.png" width="<?php echo $width; ?>">
        <img src="<?php echo SITE_PREFIX; ?>/img/share-buttons/gmail-32x32.png" alt="GMail" />
    </a>
    <a class="img-link"
       href='http://compose.mail.yahoo.com/?to=&subject=<?php echo $title; ?>&body=<?php echo $url; ?>'>
        <source type="image/webp" srcset="<?php echo SITE_PREFIX; ?>/img/share-buttons/yahoo-48x48.webp" width="<?php echo $width; ?>">
        <source type="image/png" srcset="<?php echo SITE_PREFIX; ?>/img/share-buttons/yahoo-48x48.png" width="<?php echo $width; ?>">
        <img src="<?php echo SITE_PREFIX; ?>/img/share-buttons/yahoo-32x32.png" alt="Yahoo" />
    </a>
    <a class="img-link"
       href="mailto:?Subject={{ title }}&body=<?php echo $url; ?>">
        <source type="image/webp" srcset="<?php echo SITE_PREFIX; ?>/img/share-buttons/mail-48x48.webp" width="<?php echo $width; ?>">
        <source type="image/png" srcset="<?php echo SITE_PREFIX; ?>/img/share-buttons/mail-48x48.png" width="<?php echo $width; ?>">
        <img src="<?php echo SITE_PREFIX; ?>/img/share-buttons/mail-32x32.png" alt="Email" />
    </a>
</div>
