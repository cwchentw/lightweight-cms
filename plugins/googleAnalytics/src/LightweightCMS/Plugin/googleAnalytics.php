<?php
namespace LightweightCMS\Plugin;
# Add a Google Analytics tracker for a Lightweight CMS site.

function googleAnalytics($id)
{
    $result = "";

    if ("" != $id) {
        $result .= <<<END
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={$id}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{$id}');
</script>
END;
    }

    return $result;
}
