<?php

include_once(__DIR__ . "/../../model/database.php");


include_once(__DIR__ . "/../login.php");

$title = "Animal Dashboard";
$all_animals_joined = database::select_all_animal_join_specie_order_by_animal_id_desc();

include_once(__DIR__ . "/../../view/page/admin/animal/index.phtml");

?>
