<?php

include_once(__DIR__ . "/../../config.php");
include_once(__DIR__ . "/../../model/database.php");
include_once(__DIR__ . "/../../model/specie.php");


include_once(__DIR__ . "/../login.php");

$id = database::select_latest_specie_id();
$id = $id ? ($id + 1) : 1;
$name        = $_POST["name"];
$description = $_POST["description"];
$image_url   = $_POST["image-url"];
$featured    = (bool) $_POST["featured"];

$specie = new specie($id, $name, $description, $image_url, $featured);
database::insert_into_specie($specie);

header("location: " . $base_url . "/admin/specie");

?>
