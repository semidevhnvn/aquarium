<?php

include_once(__DIR__ . "/model/database.php");


include_once(__DIR__ . "/login.php");

$title = "Account Info";
$all_pages = database::select_all_page_order_by_order();
$visitor = database::select_visitor_by_username($_SESSION["visitor-username"]);
$update_message = isset($_SESSION["update-message"]) ? $_SESSION["update-message"] : null;
$error_message = isset($_SESSION["update-error"]) ? $_SESSION["update-error"] : null;

include_once(__DIR__ . "/view/page/acount.phtml");
if (isset($_SESSION["update-message"])) /* then */ unset($_SESSION["update-message"]);
if (isset($_SESSION["update-error"])) /* then */ unset($_SESSION["update-error"]);

?>
