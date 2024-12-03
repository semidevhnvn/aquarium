<?php

class attendance_join_event_join_visitor
{
    public attendance $attendance;
    public event      $event;
    public visitor    $visitor;

    public function __construct (
        attendance $attendance,
        event      $event,
        visitor    $visitor
    ) {
        $this->attendance = $attendance;
        $this->event      = $event;
        $this->visitor    = $visitor;
    }
}

?>
