<?php

session_start();

$title = "Jenkinson's Aquarium";
$all_pages = database::select_all_page_order_by_order();
include(__DIR__ . "/view/page/index.phtml");

?>
