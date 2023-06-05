<?php
# The front-end library of a Lightweight CMS theme.
?>

<!-- Use quicklink to prefetch links based the user's current view. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/quicklink/2.3.0/quicklink.umd.js"></script>
<script>
    window.addEventListener('load', () => {
        quicklink.listen();
    });
</script>

<!-- Native JavaScript for Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/5.0.6/bootstrap-native.min.js"
    integrity="sha512-7fartC0p934pnYYM5SDo/dnxIrBIJDOxGssWFTNXMj2Zh5C1PNPKW03qe3S43HiCeZmoBe1pdGK+mK3f0VMGPw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php if (!is_null(ENABLE_CODE_HIGHTLIGHT) && ENABLE_CODE_HIGHTLIGHT): ?>
<!-- highlight.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"
    integrity="sha512-rdhY3cbXURo13l/WU9VlaRyaIYeJ/KBakckXIvJNAQde8DgpOmE+eZf7ha4vdqVjTtwQt69bD2wH2LXob/LB7Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/asciidoc.min.js"
    integrity="sha512-mLXR3rW3OU3DvkbomYwrMRp2kqDwyPvJX5ba1xIBtaxvwyAN4tOm5peiEqtF98Z6litPgflTDXl44hihB4n1aQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/nginx.min.js"
    integrity="sha512-QnJfTOp9Ong8UM1rAim6TmeikL/GlAi/Y4f+j3BU+19f1QQNUzS5Dh5o+S1mt+PMxwSnSdbd5HzVfU6TQ+4gsA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Add more highlight.js language module(s) as needed. -->
<script>hljs.highlightAll();</script>
<?php endif; ?>

<!-- Add more third-party scripts here. -->

<!-- Initialize some variables used in our JavaScript program.
      Set them before calling site-specific scripts. -->
<?php
# The variable will be a JavaScript string.
$enableFixedSidebar = "false";
if (!is_null(ENABLE_FIXED_SIDEBAR) && ENABLE_FIXED_SIDEBAR) {
    $enableFixedSidebar = "true";
}
?>
<script>
    var enableFixedSidebar = <?php echo $enableFixedSidebar; ?>;
</script>

<!-- A site-specific script -->
<script src="/js/site.js"></script>

<!-- Add more site-specific scripts here. -->
