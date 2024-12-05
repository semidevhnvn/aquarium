<?php

include_once(__DIR__ . "/../config.php");


session_start();

$_SESSION["return_url"] = $_SERVER["REQUEST_URI"];

if (isset($_SESSION["admin_username"])) {
    if ($_SESSION["return_url"] == ($base_url . "/admin/login.php")) {
        unset($_SESSION["return_url"]);
        header("location: " . $base_url . "/admin");
    }
}
else {
    $title = "Admin Login";
    $error_message = isset($_SESSION["login_error"]) ? $_SESSION["login_error"] : null;
    include_once(__DIR__ . "/../view/page/admin/login.phtml");

    exit();
}

?>
