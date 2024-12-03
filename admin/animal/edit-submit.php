<?php

include_once(__DIR__ . "/../../config.php");
include_once(__DIR__ . "/../../model/database.php");
include_once(__DIR__ . "/../../model/animal.php");


include_once(__DIR__ . "/../login.php");

$id = (int) $_POST["id"];
$specie_id = (int) $_POST["specie-id"];
$name = $_POST["name"];
$description = $_POST["description"];
$image_url = $_POST["image-url"];

$animal = new animal($id, $specie_id, $name, $description, $image_url);
database::update_animal($animal);

header("location: " . $base_url . "/admin/animal");

?>
