<?php

include_once(__DIR__ . "/../config.php");


session_start();

unset($_SESSION["admin-username"]);
header("location: " . $base_url . "/admin/login.php");

?>
