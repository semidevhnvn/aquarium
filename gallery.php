<?php

include_once(__DIR__ . "/model/database.php");


session_start();

$title = "Gallery";
$all_pages = database::select_all_page_order_by_order();
$all_species = database::select_all_specie();

$specie_name = $_GET["specie-name"];
$specie = database::select_specie_by_name($specie_name);

if (strcmp($specie_name, "all") == 0) {
    $selected_animals = database::select_all_animal_order_by_name();
}
else {
    $selected_animals = database::select_animal_by_specie_name_order_by_animal_name($specie_name);
}

include_once(__DIR__ . "/view/page/gallery.phtml");

?>
