<?php
# Pagination widget for default theme.


function totalPages($count, $perPage)
{
    $pages = $count / $perPage;

    if (is_float($pages)) {
        return floor($pages) + 1;
    }

    return $pages;
}

if (\LightweightCMS\Core\isHome($_SERVER["REQUEST_URI"])
    || (POST_PER_PAGE > 0 && \LightweightCMS\Core\isPageInHome($_SERVER["REQUEST_URI"]))) {
    $post = \LightweightCMS\Core\getAllPosts(SITE_PREFIX . "/");
}
else {
    $post = $GLOBALS[LIGHTWEIGHT_CMS_POSTS];
}

if (preg_match("/\/(\d+)\/$/", $_SERVER["REQUEST_URI"], $matches)) {
    $page = $matches[1];
}
else {
    $page = 0;
}

if ("/" == $_SERVER["REQUEST_URI"]) {
    $originalURL = "/";
}
else {
    $originalURL = preg_replace("/\/\d+\/$/", "/", $_SERVER["REQUEST_URI"]);
}
?>

<?php if (totalPages(count($post), POST_PER_PAGE) > 1): ?>
<nav aria-label="Pages">
    <ul class="pagination pagination-sm">
        <?php if ($page == 1): ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $originalURL; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php elseif ($page > 1): ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $originalURL . ($page - 1) . "/"; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php endif; ?>

        <?php
        # TODO: Update pagination widget for many posts.
        for ($i = 0; $i < totalPages(count($post), POST_PER_PAGE); ++$i) {
            if (0 == $i) {
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $originalURL . "\">" . ($i + 1) . "</a></li>";
            }
            else {
                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $originalURL . $i .  "/" . "\">" . ($i + 1) . "</a></li>";
            }
        }
        ?>

        <?php if ($page < totalPages(count($post), POST_PER_PAGE) - 1): ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $originalURL . ($page + 1) . "/"; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>
