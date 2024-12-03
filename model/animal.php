<?php

class animal
{
    private int    $id;
    private int    $specie_id;
    private string $name;
    private string $description;
    private string $image_url;

    public function __construct(
        int    $id,
        int    $specie_id,
        string $name,
        string $description,
        string $image_url
    ) {
        $this->set_id($id);
        $this->set_specie_id($specie_id);
        $this->set_name($name);
        $this->set_description($description);
        $this->set_image_url($image_url);
    }

    public function get_id () : ?int
    {
        return $this->id;
    }

    public function set_id (int $id) : void
    {
        if ($id < 0)
            throw new Exception("Invalid animal id");
        else
            $this->id = $id;
    }

    public function get_specie_id () : ?int
    {
        return $this->specie_id;
    }

    public function set_specie_id (int $specie_id) : void
    {
        if ($specie_id < 0)
            throw new Exception("Invalid specie id");
        else
            $this->specie_id = $specie_id;
    }

    public function get_name () : string
    {
        return $this->name;
    }

    public function set_name (string $name) : void
    {
        if (empty($name))
            throw new Exception("Name cannot be empty");
        else
            $this->name = $name;
    }

    public function get_description () : string
    {
        return $this->description;
    }

    public function set_description (string $description) : void
    {
        if (empty($description))
            throw new Exception("Description cannot be empty");
        else
            $this->description = $description;
    }

    public function get_image_url () : string
    {
        return $this->image_url;
    }

    public function set_image_url (string $image_url) : void
    {
        if (empty($image_url))
            throw new Exception("Image URL cannot be empty");
        else
            $this->image_url = $image_url;
    }
}

?>
