<?php
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/utils.php";

# Check whether the ?page query is set.
if (!isset($_GET["page"])) {
    $post = array();
    $post["title"] = "Bad Request Error";
    $post["content"] = "Invalid URL";
    $post["status"] = 400;
    goto render;
}

# Get page location in the ?page query param.
$loc = filter_input(INPUT_GET, "page", FILTER_SANITIZE_URL);

# Check whether the URL is dangerous.
if (false != strpos($loc, "..")) {
    $post = array();
    $post["title"] = "Bad Request Error";
    $post["content"] = "Invalid URL";
    $post["status"] = 400;
    goto render;
}

$post = fetchPage($loc);

# Fallback to default title.
if (404 == $post["status"]) {
    $post["title"] = "Page Not Found";
    $post["content"] = "The post doesn't exist on the website";
}

render:
    # Currently, we use a superglobal variable to pass data.
    # Change it later.
    $GLOBALS["post"] = $post;

    # Change it later.
    require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/post.php";
