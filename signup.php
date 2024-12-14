<?php

include_once(__DIR__ . "/model/database.php");


session_start();

$title = "Sign Up";
$all_pages = database::select_all_page_order_by_order();
$error_message = isset($_SESSION["signup-error"]) ? $_SESSION["signup-error"] : null;

include_once(__DIR__ . "/view/page/signup.phtml");
if (isset($_SESSIOn["signup-error"])) /* then */ unset($_SESSION["signup-error"]);

?>
