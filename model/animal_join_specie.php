<?php

class animal_join_specie
{
    public animal $animal;
    public specie $specie;

    public function __construct(
        animal $animal,
        specie $specie
    ) {
        $this->animal = $animal;
        $this->specie = $specie;
    }
}

?>
