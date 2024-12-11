<?php

include_once(__DIR__ . "/model/database.php");


include_once(__DIR__ . "/login.php");

$title = "Account Info";
$all_pages = database::select_all_page_order_by_order();
$visitor = database::select_visitor_by_username($_SESSION["visitor_username"]);
$update_message = isset($_SESSION["update-success"]) ? $_SESSION["update-success"] : null;

include_once(__DIR__ . "/view/page/acount.phtml");

?>
