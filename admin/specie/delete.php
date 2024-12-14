<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$id = (int) $_GET["id"];
$specie = database::select_specie_by_id($id);

$selected_animals = database::select_animal_by_specie_id($specie->get_id());

if (! empty($selected_animals)) {
    $_SESSION["delete-error"] = "The specie relates to some animal records";
    header("location: " . $base_url . "/admin/specie");
}
else {
    database::delete_from_specie($specie);
    include_once(__DIR__ . "/../../view/page/admin/specie/delete.phtml");
}

?>
