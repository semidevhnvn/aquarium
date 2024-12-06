<?php

class review
{
    private int    $id;
    private int    $visitor_id;
    private int    $rating;
    private string $feedback;
    private string $submit_time;

    public function __construct (
        int    $id,
        int    $visitor_id,
        int    $rating,
        string $feedback,
        string $submit_time
    ) {
        $this->set_id($id);
        $this->set_visitor_id($visitor_id);
        $this->set_rating($rating);
        $this->set_feedback($feedback);
        $this->set_submit_time($submit_time);
    }

    public function get_id () : int
    {
        return $this->id;
    }

    public function set_id (int $id) : void
    {
        if ($id < 0)
            throw new Exception("Invalid review id");
        else
            $this->id = $id;
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

    public function get_rating () : int
    {
        return $this->rating;
    }

    public function set_rating (int $rating) : void
    {
        if ($rating < 1 || 10 < $rating)
            throw new Exception("Invalid rating");
        else
            $this->rating = $rating;
    }

    public function get_feedback () : string
    {
        return $this->feedback;
    }

    public function set_feedback (string $feedback) : void
    {
        if (empty($feedback))
            throw new Exception("Feedback cannot be empty");
        else
            $this->feedback = $feedback;
    }

    public function get_submit_time () : string
    {
        return $this->submit_time;
    }

    public function set_submit_time (string $submit_time) : void
    {
        if (empty($submit_time))
            throw new Exception("Submit time cannot be empty");
        else
            $this->submit_time = $submit_time;
    }
}

?>
