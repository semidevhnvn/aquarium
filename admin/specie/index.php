<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Index Specie";
$all_species = database::select_all_specie();
$error_message = isset($_SESSION["delete_error"]) ? $_SESSION["delete_error"] : null;

include_once(__DIR__ . "/../../view/page/admin/specie/index.phtml");

?>
