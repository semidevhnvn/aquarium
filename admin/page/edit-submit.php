<?php

include_once(__DIR__ . "/../../config.php");
include_once(__DIR__ . "/../../model/database.php");
include_once(__DIR__ . "/../../model/page.php");


include_once(__DIR__ . "/../login.php");

$id        = $_SESSION["submitted-id"]        = $_POST["id"];
$menu_name = $_SESSION["submitted-menu-name"] = $_POST["menu-name"];
$title     = $_SESSION["submitted-title"]     = $_POST["title"];
$body_text = $_SESSION["submitted-body-text"] = $_POST["body-text"];
$order     = $_SESSION["submitted-order"]     = (int) $_POST["order"];

$page_matched_order = database::select_page_by_order($order);
if (isset($page_matched_order) && $page_matched_order->get_id() != $id) {
    $_SESSION["edit-error"] = "Page order is already taken";
    header("location: " . $base_url . "/admin/page/edit.php?id=" . $id);
}
else {
    $page = new page($id, $menu_name, $title, $body_text, $order);
    unset($_SESSION["submitted-id"]);
    unset($_SESSION["submitted-menu-name"]);
    unset($_SESSION["submitted-title"]);
    unset($_SESSION["submitted-body-text"]);
    unset($_SESSION["submitted-order"]);
    unset($_SESSION["edit-error"]);
    database::update_page($page);
    header("location: " . $base_url . "/admin/page");
}

?>
