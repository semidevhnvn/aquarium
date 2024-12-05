<?php

include_once(__DIR__ . "/model/database.php");


session_start();

$title = "Jenkinson's Aquarium";
$all_pages = database::select_all_page_order_by_order();
$featured_species = database::select_featured_specie();
$upcoming_events = database::select_upcoming_event(date('Y-m-d h:m:s', time()));
include(__DIR__ . "/view/page/index.phtml");

?>
