<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Edit Page";

$id = (int) $_GET["id"];
$page = database::select_page_by_id($id);
$edit_error = isset($_SESSION["edit-error"]) ? $_SESSION["edit-error"] : null;

include_once(__DIR__ . "/../../view/page/admin/page/edit.phtml");

?>
