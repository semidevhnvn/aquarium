<?php

include_once(__DIR__ . "/model/database.php");


session_start();

$id = (int) $_GET["id"];
$animal = database::select_animal_by_id($id);

$title = $animal->get_name();
$all_pages = database::select_all_page_order_by_order();
include_once(__DIR__ . "/view/page/animal.phtml");

?>
