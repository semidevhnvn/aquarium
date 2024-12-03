<?php

class visitor
{
    private int    $id;
    private string $fullname;
    private string $username;
    private string $password;
    private string $email;
    private string $phone;
    private string $birthday;

    public function __construct (
        int    $id,
        string $fullname,
        string $username,
        string $password,
        string $email,
        string $phone,
        string $birthday
    ) {
        $this->set_id($id);
        $this->set_fullname($fullname);
        $this->set_username($username);
        $this->set_password($password);
        $this->set_email($email);
        $this->set_phone($phone);
        $this->set_birthday($birthday);
    }

    public function get_id () : int
    {
        return $this->id;
    }

    public function set_id (int $id) : void
    {
        if ($id < 0)
            throw new Exception("Invalid visitor id");
        else
            $this->id = $id;
    }

    public function get_fullname () : string
    {
        return $this->fullname;
    }

    public function set_fullname (string $fullname) : void
    {
        if (empty($fullname))
            throw new Exception("Full-name cannot be empty");
        else
            $this->fullname = $fullname;
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

    public function get_email () : string
    {
        return $this->email;
    }

    public function set_email (string $email) : void
    {
        if (empty($email))
            throw new Exception("Email cannot be empty");
        else
            $this->email = $email;
    }

    public function get_phone () : string
    {
        return $this->phone;
    }

    public function set_phone (string $phone) : void
    {
        if (empty($phone))
            throw new Exception("Phone cannot be empty");
        else
            $this->phone = $phone;
    }

    public function get_birthday () : string
    {
        return $this->birthday;
    }

    public function set_birthday (string $birthday) : void
    {
        if (empty($birthday))
            throw new Exception("Birthday cannot be empty");
        else
            $this->birthday = $birthday;
    }
}

?>
