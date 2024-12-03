<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$id = (int) $_GET["id"];
$page = database::select_page_by_id($id);

database::delete_from_page($page);
include_once(__DIR__ . "/../../view/page/admin/page/delete.phtml");

?>
