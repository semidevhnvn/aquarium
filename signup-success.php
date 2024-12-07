<?php

include_once(__DIR__ . "/model/database.php");


session_start();

$title = "Signup Success";
$all_pages = database::select_all_page_order_by_order();
include_once(__DIR__ . "/view/page/signup-success.phtml");

?>
