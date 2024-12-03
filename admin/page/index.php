<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Page Index";
$all_pages = database::select_all_page();
include_once(__DIR__ . "/../../view/page/admin/page/index.phtml");

?>
