<?php

class administrator
{
    private int    $id;
    private string $username;
    private string $password;

    public function __construct (
        int    $id,
        string $username,
        string $password
    ) {
        $this->set_id($id);
        $this->set_username($username);
        $this->set_password($password);
    }

    public function get_id () : int
    {
        return $this->id;
    }

    public function set_id (int $id) : void
    {
        if ($id <= 0)
            throw new Exception("Invalid range of id");
        else
            $this->id = $id;
    }

    public function get_username () : string
    {
        return $this->username;
    }

    public function set_username (string $username) : void
    {
        if (empty($username))
            throw new Exception("Username cannot be empty");
        else
            $this->username = $username;
    }

    public function get_password () : string
    {
        return $this->password;
    }

    public function set_password (string $password) : void
    {
        if (empty($password))
            throw new Exception("Password cannot be empty");
        else
            $this->password = $password;
    }
}

?>
