<?php

include_once(__DIR__ . "/config.php");
include_once(__DIR__ . "/model/database.php");
include_once(__DIR__ . "/model/visitor.php");


session_start();

$id = database::select_latest_visitor_id();
$id = ($id) ? ($id+1) : 1;
$fullname = $_SESSION["submitted-fullname"] = $_POST["fullname"];
$username = $_SESSION["submitted-username"] = $_POST["username"];
$password = $_SESSION["submitted-password"] = $_POST["password"];
$confirm_password = $_SESSION["submitted-confirm-password"] = $_POST["confirm-password"];
$email    = $_SESSION["submitted-email"]    = $_POST["email"];
$phone    = $_SESSION["submitted-phone"]    = $_POST["phone"];
$birthday = $_SESSION["submitted-birthday"] = $_POST["birthday"];

$matched_username_account = database::select_visitor_by_username($username);
if (isset($matched_username_account)) {
    $_SESSION["error_message"] = "The username has been used by other";
    header("location: " . $base_url . "/signup.php");
}

$matched_email_account = database::select_visitor_by_email($email);
if (isset($matched_email_account)) {
    $_SESSION["error_message"] = "The email has been used by other";
    header("location: " . $base_url . "/signup.php");
}

$matched_phone_account = database::select_visitor_by_phone($phone);
if (isset($matched_phone_account)) {
    $_SESSION["error_message"] = "The phone has been used by other";
    header("location: " . $base_url . "/signup.php");
}

if ($password != $confirm_password) {
    $_SESSION["error_message"] = "The confirm password does not match";
    header("location: " . $base_url . "/signup.php");
}

$visitor = new visitor($id, $fullname, $username, $password, $email, $phone, $birthday);
database::insert_into_visitor($visitor);

if (isset($_SESSION["submitted-fullname"])) /* then */ unset($_SESSION["submitted-fullname"]);
if (isset($_SESSION["submitted-username"])) /* then */ unset($_SESSION["submitted-username"]);
if (isset($_SESSION["submitted-password"])) /* then */ unset($_SESSION["submitted-password"]);
if (isset($_SESSION["submitted-confirm-password"])) /* then */ unset($_SESSION["submitted-confirm-password"]);
if (isset($_SESSION["submitted-email"])) /* then */ unset($_SESSION["submitted-email"]);
if (isset($_SESSION["submitted-phone"])) /* then */ unset($_SESSION["submitted-phone"]);
if (isset($_SESSION["submitted-birthday"])) /* then */ unset($_SESSION["submitted-birthday"]);
header("location: " . $base_url . "/signup-success.php");

?>
