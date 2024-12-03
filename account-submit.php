<?php

include_once(__DIR__ . "/config.php");
include_once(__DIR__ . "/model/database.php");


session_start();

$id       = $_SESSION["id"]                 = (int) $_POST["id"];
$fullname = $_SESSION["submitted-fullname"] = $_POST["fullname"];
$username = $_SESSION["submitted-username"] = $_POST["username"];
$password = $_SESSION["submitted-password"] = $_POST["password"];
$confirm_password = $_SESSION["submitted-confirm-password"] = $_POST["confirm-password"];
$email    = $_SESSION["submitted-email"]    = $_POST["email"];
$phone    = $_SESSION["submitted-phone"]    = $_POST["phone"];
$birthday = $_SESSION["submitted-birthday"] = $_POST["birthday"];

$matched_username_account = database::select_visitor_by_username($username);
if (isset($matched_username_account) && ($id != $matched_username_account->get_id())) {
    $_SESSION["error_message"] = "The username has been used by other";
    header("location: " . $base_url . "/signup.php");
}

$matched_email_account = database::select_visitor_by_email($email);
if (isset($matched_email_account) && ($id != $matched_email_account->get_id())) {
    $_SESSION["error_message"] = "The email has been used by other";
    header("location: " . $base_url . "/signup.php");
}

$matched_phone_account = database::select_visitor_by_phone($phone);
if (isset($matched_phone_account)  && ($id != $matched_phone_account->get_id())) {
    $_SESSION["error_message"] = "The phone has been used by other";
    header("location: " . $base_url . "/signup.php");
}

if ($password != $confirm_password) {
    $_SESSION["error_message"] = "The confirm password does not match";
    header("location: " . $base_url . "/signup.php");
}

$visitor = new visitor($id, $fullname, $username, $password, $email, $phone, $birthday);
database::update_visitor($visitor);

$_SESSION["update-success"] = "Your account info has been updated successfully";
header("location: " . $base_url . "/account.php");

?>
