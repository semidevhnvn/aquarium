<?php

include_once(__DIR__ . "/config.php");
include_once(__DIR__ . "/model/database.php");
include_once(__DIR__ . "/model/review.php");


session_start();

$id = database::select_latest_review_id();
$id = ($id) ? ($id+1) : 1;
$visitor = database::select_visitor_by_username($_SESSION["visitor-username"]);
$visitor_id = $visitor->get_id();
$rating = (int) $_POST["rating"];
$feedback = $_POST["feedback"];
date_default_timezone_set("Asia/Ho_Chi_Minh");
$submit_time = date("Y-m-d h:m:s", time());

$review = new review($id, $visitor_id, $rating, $feedback, $submit_time);
database::insert_into_review($review);

header("location: " . $base_url . "/reviews.php");

?>
