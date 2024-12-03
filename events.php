<?php

include_once(__DIR__ . "/model/database.php");

$title = "Events";
$all_pages = database::select_all_page_order_by_order();
$all_events = database::select_all_event();
include_once(__DIR__ . "/view/page/events.phtml");

?>
