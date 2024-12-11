<?php

include_once(__DIR__ . "/model/database.php");


session_start();

$title = "Visitor's Reviews";
$all_pages = database::select_all_page_order_by_order();
$all_reviews_joined = database::select_all_review_join_visitor_order_by_submit_time_desc();

include_once(__DIR__ . "/view/page/reviews.phtml");

?>
