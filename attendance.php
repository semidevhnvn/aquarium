<?php

include_once(__DIR__ . "/model/database.php");


include_once(__DIR__ . "/login.php");

$title = "Attendance";
$all_pages = database::select_all_page_order_by_order();

$username = $_SESSION["username"];
$visitor = database::select_visitor_by_username($username);

$all_attendances_joined = database::select_attendance_join_event_by_visitor_id($visitor->get_id());

include_once(__DIR__ . "/view/page/attendance.phtml");

?>
