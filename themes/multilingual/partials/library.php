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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/4.2.0/bootstrap-native.min.js"
    integrity="sha512-GmnAinnWwLr6TlNR+oVdAJE+Nymkf+WkXsZBLTEnJ0GuWhReyRd3GRZHxYw6zHoMPqG6N+/OTm1R6pnCb+MVAQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php if (!is_null(ENABLE_CODE_HIGHTLIGHT) && ENABLE_CODE_HIGHTLIGHT): ?>
<!-- highlight.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"
    integrity="sha512-gU7kztaQEl7SHJyraPfZLQCNnrKdaQi5ndOyt4L4UPL/FHDd/uB9Je6KDARIqwnNNE27hnqoWLBq+Kpe4iHfeQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/languages/asciidoc.min.js"
    integrity="sha512-NMQe4J2795tJcPdY14h2z6QUYZH/3OoMAIUs1URGrAF+N2mSiEcQ/L68Pv+pBCEDwnzeZuV2LgfgGZn/SpvpFg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/languages/nginx.min.js"
    integrity="sha512-0Z15/1ggjI+buaadbxMd/Ix4CvFrCCso/hu/RWrxY+zlhIHSiYCVCkTk99sLHtjIsNbhdsl/qVoK14ngLsXk6w=="
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
