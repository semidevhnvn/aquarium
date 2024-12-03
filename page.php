<?php

include_once(__DIR__ . "/model/database.php");


$id = (int) $_GET["id"];
$page = database::select_page_by_id($id);

$title = $page->get_title();
$all_pages = database::select_all_page_order_by_order();
include_once(__DIR__ . "/view/page/page.phtml");

?>
