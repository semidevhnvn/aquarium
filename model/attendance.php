<?php

class attendance
{
    private int $event_id;
    private int $visitor_id;

    public function __construct (int $event_id, int $visitor_id)
    {
        $this->set_event_id($event_id);
        $this->set_visitor_id($visitor_id);
    }

    public function get_event_id () : int
    {
        return $this->event_id;
    }

    public function set_event_id (int $event_id) : void
    {
        if ($event_id < 0)
            throw new Exception("Invalid event id");
        else
            $this->event_id = $event_id;
    }

    public function get_visitor_id () : int
    {
        return $this->visitor_id;
    }

    public function set_visitor_id (int $visitor_id) : void
    {
        if ($visitor_id < 0)
            throw new Exception("Invalid visitor id");
        else
            $this->visitor_id = $visitor_id;
    }
}

?>
