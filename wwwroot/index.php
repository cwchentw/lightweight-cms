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

render:
    if (isset($post) && 200 != $post["status"]) {
        # Currently, we use a superglobal variable to pass data.
        $GLOBALS["post"] = $post;

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/post.php";
    }
    else {
        $post = fetchPage($loc);

        # HTTP 404.
        if (404 == $post["status"]) {
            $post["title"] = "Page Not Found";
            $post["content"] = "The post doesn't exist on the website";
        }

        # Currently, we use a superglobal variable to pass data.
        $GLOBALS["post"] = $post;

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/post.php";
    }
