<?php

include_once(__DIR__ . "/../login.php");
include_once(__DIR__ . "/../../model/database.php");
include_once(__DIR__ . "/../../model/event.php");


$id            = (int) $_POST["id"];
$kids_only     = (bool) $_POST["kids-only"];
$name          = $_POST["name"];
$description   = $_POST["description"];
$image_url     = $_POST["image-url"];
$starting_time = $_POST["starting-time"];

$event = new event($id, $kids_only, $name, $description, $image_url, $starting_time);
database::update_event($event);

header("location: " . $base_url . "/admin/event");

?>
