<?php
# Footer of a mdcms theme.
#
# Currently, there is no real footer part in rendered pages.
#  This PHP script is merely for Javascript program loading.
?>

<!-- Native JavaScript for Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/4.0.7/bootstrap-native.min.js"
    integrity="sha512-8otC61oMBEZ1fT8Oi+a0mZEJHy2cSUhFnCS44L8B9erhfxO8cuRGSJo0Dhgw42Vw7g+PaJ8pTxFlUsa+zLbUsA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php if (!is_null(ENABLE_CODE_HIGHTLIGHT) && ENABLE_CODE_HIGHTLIGHT): ?>
<!-- highlight.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"
    integrity="sha512-Pbb8o120v5/hN/a6LjF4N4Lxou+xYZ0QcVF8J6TWhBbHmctQWd8O6xTDmHpE/91OjPzCk4JRoiJsexHYg4SotQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/languages/nginx.min.js"
    integrity="sha512-y3Mryvd8MCT1x8PScKC/zmbJTai3P3H6+5WH1yPpCV3UzoI3dKum7qyTeB92e1qwKnhMWjfWkTEN1Okz5rvvWg=="
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
