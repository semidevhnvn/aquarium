<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$id = (int) $_GET["id"];
$review_joined = database::select_review_join_visitor_by_review_id($id);
database::delete_from_review($review_joined->review);
include_once(__DIR__ . "/../../view/page/admin/review/delete.phtml");

?>
