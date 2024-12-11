<?php

include_once(__DIR__ . "/model/database.php");


include_once(__DIR__ . "/login.php");

$title = "Add Review";
$all_pages = database::select_all_page_order_by_order();

include_once(__DIR__ . "/view/page/review-add.phtml");

?>
