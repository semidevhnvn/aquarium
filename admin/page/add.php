<?php

include_once(__DIR__ . "/../login.php");

$title = "Add Page";
$add_error = isset($_SESSION["add-error"]) ? $_SESSION["add-error"] : null;

include_once(__DIR__ . "/../../view/page/admin/page/add.phtml");

?>
