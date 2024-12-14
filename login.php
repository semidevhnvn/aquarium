<?php

include_once(__DIR__ . "/config.php");
include_once(__DIR__ . "/model/database.php");


session_start();

$_SESSION["return-url"] = $_SERVER["REQUEST_URI"];

if (isset($_SESSION["visitor-username"])) {
    if ($_SESSION["return-url"] == ($base_url . "/login.php")) {
        unset($_SESSION["return-url"]);
        header("location: " . $base_url);
    }
}
else {
    $title = "Visitor Login";
    $all_pages = database::select_all_page_order_by_order();
    $error_message = isset($_SESSION["login-error"]) ? $_SESSION["login-error"] : null;

    include_once(__DIR__ . "/view/page/login.phtml");
    if (isset($_SESSION["login-error"])) /* then */ unset($_SESSION["login-error"]);
    exit();
}

?>
