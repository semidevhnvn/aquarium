<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$id = (int) $_GET["id"];
$event = database::select_event_by_id($id);

database::delete_from_event($event);
include_once(__DIR__ . "/../../view/page/admin/event/delete.phtml");

?>
