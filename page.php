<?php

include_once(__DIR__ . "/model/database.php");


session_start();

$slug = $_GET["slug"];
$page = database::select_page_by_slug($slug);

$title = $page->get_title();
$all_pages = database::select_all_page_order_by_order();

include_once(__DIR__ . "/view/page/page.phtml");

?>
