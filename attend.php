<?php

include_once(__DIR__ . "/config.php");
include_once(__DIR__ . "/model/database.php");
include_once(__DIR__ . "/model/attendance.php");


include_once(__DIR__ . "/login.php");

$event_id = (int) $_GET["event-id"];

$username = $_SESSION["visitor_username"];
$visitor = database::select_visitor_by_username($username);

$all_attendances_joined = database::select_attendance_join_event_by_visitor_id($visitor->get_id());
foreach ($all_attendances_joined as $attendance_joined) {
    if ($attendance_joined->attendance->get_event_id() == $event_id) {
        header("location: " . $base_url . "/attendance.php");
        exit();
    }
}

$attendance = new attendance($event_id, $visitor->get_id());
database::insert_into_attendance($attendance);

header("location: " . $base_url . "/attendance.php");

?>
