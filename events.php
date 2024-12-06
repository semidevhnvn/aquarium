<?php

include_once(__DIR__ . "/model/database.php");

session_start();

$title = "Events";
$all_pages = database::select_all_page_order_by_order();
date_default_timezone_set("Asia/Ho_Chi_Minh");
$upcoming_events = database::select_upcoming_event(date("Y-m-d h:m:s", time()));
include_once(__DIR__ . "/view/page/events.phtml");

?>
