<?php

include_once(__DIR__ . "/config.php");
include_once(__DIR__ . "/model/database.php");
include_once(__DIR__ . "/model/attendance.php");


include_once(__DIR__ . "/login.php");

$event_id = (int) $_GET["event-id"];

$username = $_SESSION["visitor-username"];
$visitor = database::select_visitor_by_username($username);

$selected_attendances = database::select_attendance_by_visitor_id_order_by_event_id_desc($visitor->get_id());

foreach ($selected_attendances as $attendance) {
    if ($attendance->get_event_id() == $event_id) {
        header("location: " . $base_url . "/attendance.php");
        exit();
    }
}

$attendance = new attendance($event_id, $visitor->get_id());
database::insert_into_attendance($attendance);

header("location: " . $base_url . "/attendance.php");

?>
