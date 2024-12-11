<?php

include_once(__DIR__ . "/model/database.php");


session_start();

$title = "Sign Up";
$all_pages = database::select_all_page_order_by_order();
$error_message = isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : null;

include_once(__DIR__ . "/view/page/signup.phtml");

?>
