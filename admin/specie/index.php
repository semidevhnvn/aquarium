<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Index Specie";
$all_species = database::select_all_specie();
include_once(__DIR__ . "/../../view/page/admin/specie/index.phtml");

?>
