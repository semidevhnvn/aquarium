<?php

include_once(__DIR__ . "/model/database.php");

session_start();

$title = "Events";
$all_pages = database::select_all_page_order_by_order();
$all_events = database::select_all_event_order_by_starting_time();
include_once(__DIR__ . "/view/page/events.phtml");

?>
