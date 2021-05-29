<?php
require_once __DIR__ . "/../setting.php";
require_once __DIR__ . "/../" . LIBRARY_DIRECTORY . "/utils.php";

# Remove it later.
$loc = "/c-programming/hello-world/";
goto render;

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

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . POST_LAYOUT;
    }
    else if (isHomePage($loc)) {
        # Pass required variables here.

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . INDEX_LAYOUT;
    }
    else {
        $post = readPage($loc);

        # HTTP 404 Page.
        if (404 == $post["status"]) {
            $post["title"] = "Page Not Found";
            $post["content"] = "The post doesn't exist on the website";
        }

        # Currently, we use a superglobal variable to pass data.
        $GLOBALS["post"] = $post;

        require __DIR__ . "/../" . LAYOUT_DIRECTORY . "/" . POST_LAYOUT;
    }
