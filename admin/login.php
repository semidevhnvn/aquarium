<?php

include_once(__DIR__ . "/../config.php");


session_start();

$_SESSION["return-url"] = $_SERVER["REQUEST_URI"];

if (isset($_SESSION["admin-username"])) {
    if ($_SESSION["return-url"] == ($base_url . "/admin/login.php")) {
        unset($_SESSION["return-url"]);
        header("location: " . $base_url . "/admin");
    }
}
else {
    $title = "Admin Login";
    $error_message = isset($_SESSION["login-error"]) ? $_SESSION["login-error"] : null;

    include_once(__DIR__ . "/../view/page/admin/login.phtml");
    if (isset($_SESSION["login-error"])) /* then */ unset($_SESSION["login-error"]);
    exit();
}

?>
