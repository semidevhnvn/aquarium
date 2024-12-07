<?php

include_once(__DIR__ . "/config.php");


session_start();

unset($_SESSION["visitor_username"]);
header("location: " . $base_url);

?>
