<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Attendance Index";
$all_attendances_joined = database::select_all_attendance_join_event_join_visitor_order_by_event_id_asc();
include_once(__DIR__ . "/../../view/page/admin/attendance/index.phtml");

?>
