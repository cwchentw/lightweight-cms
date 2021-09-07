<?php
# Footer of a mdcms theme.
#
# Currently, there is no real footer part in rendered pages.
#  This PHP script is merely for Javascript program loading.
?>

<!-- Native JavaScript for Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/4.0.3/bootstrap-native.min.js"
    integrity="sha512-AQMIF/Dretc0m1KBmsTj0FNUeR7OZKw+DKAK+/jqrpalPQAP7ODqKJB6wHBPP6MDTKS52LYPihNa1cEpil8zaA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php if (!is_null(ENABLE_CODE_HIGHTLIGHT) && ENABLE_CODE_HIGHTLIGHT): ?>
<!-- highlight.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"
    integrity="sha512-MinqHeqca99q5bWxFNQEQpplMBFiUNrEwuuDj2rCSh1DgeeTXUgvgYIHZ1puBS9IKBkdfLMSk/ZWVDasa3Y/2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/languages/nginx.min.js"
    integrity="sha512-lot9koe73sfXIrUvIPM/UEhuMciN56RPyBdOyZgfO53P2lkWyyXN7J+njcxIIBRV+nVDQeiWtiXg+bLAJZDTfg=="
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
