<?php

include_once(__DIR__ . "/model/database.php");


session_start();

$title = "Event";
$all_pages = database::select_all_page_order_by_order();
$id = (int) $_GET["id"];
$event = database::select_event_by_id($id);

include_once(__DIR__ . "/view/page/event.phtml");

?>
