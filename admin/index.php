<?php

include_once(__DIR__ . "/../model/database.php");


include_once(__DIR__ . "/login.php");

$title = "Admin Dashboard";
$animal_count = database::select_count_all_animal();
$specie_count = database::select_count_all_specie();
$event_count = database::select_count_all_event();
$visitor_count = database::select_count_all_visitor();
$attendance_count = database::select_count_all_attendance();
$page_count = database::select_count_all_page();
include_once(__DIR__ . "/../view/page/admin/index.phtml");

?>
