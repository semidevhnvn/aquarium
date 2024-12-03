<?php

class attendance_join_event
{
    public attendance $attendance;
    public event      $event;

    public function __construct (
        attendance $attendance,
        event      $event
    ) {
        $this->attendance = $attendance;
        $this->event      = $event;
    }
}

?>
