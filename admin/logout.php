<?php

include_once(__DIR__ . "/../config.php");


session_start();

unset($_SESSION["admin_username"]);
header("location: " . $base_url . "/admin/login.php");

?>
