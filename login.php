<?php

include_once(__DIR__ . "/config.php");


session_start();

$_SESSION["return_url"] = $_SERVER['REQUEST_URI'];

if (isset($_SESSION["username"])) {
    if ($_SESSION["return_url"] == ($base_url . "/login.php")) {
        unset($_SESSION["return_url"]);
        header("location: " . $base_url);
    }
}
else {
    $title = "Visitor Login";
    $all_pages = database::select_all_page_order_by_order();
    $error_message = isset($_SESSION["login_error"]) ? $_SESSION["login_error"] : null;
    include_once(__DIR__ . "/view/page/login.phtml");

    exit();
}

?>
