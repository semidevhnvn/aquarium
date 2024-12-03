<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Edit Animal";
$id = (int) $_GET["id"];
$animal = database::select_animal_by_id($id);
$all_species = database::select_all_specie();
include_once(__DIR__ . "/../../view/page/admin/animal/edit.phtml");

?>
