<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Index Specie";
$all_species = database::select_all_specie_order_by_id_desc();
$error_message = isset($_SESSION["delete-error"]) ? $_SESSION["delete-error"] : null;

include_once(__DIR__ . "/../../view/page/admin/specie/index.phtml");
if (isset($_SESSION["delete-error"])) /* then */ unset($_SESSION["delete-error"]);

?>
