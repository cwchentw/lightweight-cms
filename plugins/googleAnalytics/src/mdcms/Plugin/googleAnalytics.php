<?php
namespace mdcms\Plugin;
# Add a Google Analytics tracker for a mdcms site.

function googleAnalytics($id)
{
    $result = "";

    if ("" != $id) {
        $result .= <<<END
<script async src="https://www.googletagmanager.com/gtag/js?id={$id}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    
    gtag('config', '{$id}');
</script>
END;
    }

    return $result;
}
