<?php

include_once(__DIR__ . "/../config.php");
include_once(__DIR__ . "/../model/database.php");


session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$account = database::select_admin_by_login_info($username, $password);

if ($account == null) {
    $_SESSION["login_error"] = "Invalid login info";
    $_SESSION["submitted-username"] = $_POST["username"];
    $_SESSION["submitted-password"] = $_POST["password"];
    header("location: {$_SESSION["return_url"]}");
}
else {
    if (isset["login_error"]) /* then */ unset($_SESSION["login_error"]);
    $_SESSION["username"] = $account->get_username();

    if (isset($_SESSION["return_url"]))
        header("location: {$_SESSION["return_url"]}");
    else
        header("location: " . $base_url . "/admin/");

    unset($_SESSION["return_url"]);
}

?>
