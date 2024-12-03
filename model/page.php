<?php

class page
{
    private int    $id;
    private string $menu_name;
    private string $title;
    private string $body_text;
    private int    $order;

    public function __construct (
        int    $id,
        string $menu_name,
        string $title,
        string $body_text,
        int    $order
    ) {
        $this->set_id($id);
        $this->set_menu_name($menu_name);
        $this->set_title($title);
        $this->set_body_text($body_text);
        $this->set_order($order);    }

    public function get_id () : int
    {
        return $this->id;
    }

    public function set_id (int $id) : void
    {
        if ($id < 0)
            throw new Exception("Invalid page id");
        else
            $this->id = $id;
    }

    public function get_menu_name () : string
    {
        return $this->menu_name;
    }

    public function set_menu_name (string $menu_name) : void
    {
        if (empty($menu_name))
            throw new Exception("Menu name cannot be empty");
        else
            $this->menu_name = $menu_name;
    }

    public function get_title () : string
    {
        return $this->title;
    }

    public function set_title (string $title) : void
    {
        if (empty($title))
            throw new Exception("Title cannot be empty");
        else
            $this->title = $title;
    }

    public function get_body_text () : string
    {
        return $this->body_text;
    }

    public function set_body_text (string $body_text) : void
    {
        if (empty($body_text))
            throw new Exception("Body name cannot be empty");
        else
            $this->body_text = $body_text;
    }

    public function get_order () : int
    {
        return $this->order;
    }

    public function set_order (int $order) : void
    {
        if ($order < 0)
            throw new Exception("Invalid page order");
        else
            $this->order = $order;
    }
}

?>
