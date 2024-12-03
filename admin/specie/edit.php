<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$id = (int) $_GET["id"];
$specie = database::select_specie_by_id($id);

$title = "Edit Specie";
include_once(__DIR__ . "/../../view/page/admin/specie/edit.phtml");

?>
