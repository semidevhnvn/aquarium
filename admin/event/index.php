<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Event Dashboard";
$all_events = database::select_all_event();
include_once(__DIR__ . "/../../view/page/admin/event/index.phtml");

?>
