<?php

include_once(__DIR__ . "/../config.php");
include_once(__DIR__ . "/../model/database.php");


session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$admin = database::select_admin_by_login_info($username, $password);

if ($admin == null) {
    $_SESSION["login-error"] = "Invalid login info";
    $_SESSION["submitted-username"] = $_POST["username"];
    $_SESSION["submitted-password"] = $_POST["password"];
    header("location: {$_SESSION["return-url"]}");
}
else {
    if (isset($_SESSION["login-error"])) /* then */ unset($_SESSION["login-error"]);

    $_SESSION["admin-username"] = $admin->get_username();

    if (isset($_SESSION["return-url"]))
        header("location: {$_SESSION["return-url"]}");
    else
        header("location: " . $base_url . "/admin/");

    unset($_SESSION["return-url"]);
}

?>
