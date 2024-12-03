<?php

include_once(__DIR__ . "/../../config.php");
include_once(__DIR__ . "/../../model/database.php");
include_once(__DIR__ . "/../../model/page.php");


include_once(__DIR__ . "/../login.php");

$id = database::select_latest_page_id();
$id = $id ? ($id + 1) : 1;
$menu_name = $_SESSION["submitted-menu-name"] = $_POST["menu-name"];
$title     = $_SESSION["submitted-title"]     = $_POST["title"];
$body_text = $_SESSION["submitted-body-text"] = $_POST["body-text"];
$order     = $_SESSION["submitted-order"]     = (int) $_POST["order"];

$page_matched_order = database::select_page_by_order($order);

if (isset($page_matched_order)) {
    $_SESSION["add-error"] = "Page order is already taken";
    header("location: " . $base_url . "/admin/page/add.php");
}
else {
    $page = new page($id, $menu_name, $title, $body_text, $order);
    unset($_SESSION["submitted-menu-name"]);
    unset($_SESSION["submitted-title"]);
    unset($_SESSION["submitted-body-text"]);
    unset($_SESSION["submitted-order"]);
    unset($_SESSION["add-error"]);
    database::insert_into_page($page);
    header("location: " . $base_url . "/admin/page");
}

?>
