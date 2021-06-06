<!-- Native JavaScript for Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap.native/3.0.15/bootstrap-native.min.js"
    integrity="sha512-ui7r9OLlcZJsUe16m7uoiyX9wBdbLds3zB5WCtlV+Sp+2U/wFFhGbp8Q4BfPbFEb0iBG07LsCvHDVySlVmgJAw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php if (ENABLE_CODE_HIGHTLIGHT): ?>
<!-- highlight.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js"
    integrity="sha512-s+tOYYcC3Jybgr9mVsdAxsRYlGNq4mlAurOrfNuGMQ/SCofNPu92tjE7YRZCsdEtWL1yGkqk15fU/ark206YTg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>hljs.highlightAll();</script>
<?php endif; ?>

<!-- Add more third-party scripts here. -->

<!-- Initialize some variables used in our JavaScript program.
      Set them before calling site-specific scripts. -->
<script>
    var enableFixedSidebar = <?php if (null != ENABLE_FIXED_SIDEBAR && ENABLE_FIXED_SIDEBAR) { echo "true"; } else { echo "false"; } ?>;
</script>

<!-- A site-specific script -->
<script src="/js/site.js"></script>

<!-- Add more site-specific scripts here. -->
