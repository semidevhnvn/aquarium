<?php

include_once(__DIR__ . "/model/database.php");


session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$matched_username_account = database::select_visitor_by_username($username);

if ($matched_username_account == null) {
    $_SESSION["login-error"] = "Invalid login info";
    header("location: " . $base_url . "/login.php");
}

else if (! password_verify($password, $matched_username_account->get_password())) {
    $_SESSION["login-error"] = "Invalid login info";
    header("location: " . $base_url . "/login.php");
}

else {
    if (isset($_SESSION["login-error"])) /* then */ unset($_SESSION["login-error"]);
    $_SESSION["visitor-username"] = $matched_username_account->get_username();
    header("location: " . $_SESSION["return-url"]);
}

?>
