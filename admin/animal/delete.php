<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$id = (int) $_GET["id"];
$animal = database::select_animal_by_id($id);

database::delete_from_animal($animal);
include_once(__DIR__ . "/../../view/page/admin/animal/delete.phtml");

?>
