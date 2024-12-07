<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Review Index";
$all_reviews_joined = database::select_all_review_join_visitor_order_by_submit_time_desc();
include_once(__DIR__ . "/../../view/page/admin/review/index.phtml");

?>
