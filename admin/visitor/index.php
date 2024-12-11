<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Visitor Dashboard";
$all_visitors = database::select_all_visitor();

include_once(__DIR__ . "/../../view/page/admin/visitor/index.phtml");

?>
