<?php

include_once(__DIR__ . "/review.php");
include_once(__DIR__ . "/visitor.php");


class review_join_visitor
{
    public review  $review;
    public visitor $visitor;

    public function __construct (
        review  $review,
        visitor $visitor
    ) {
        $this->review  = $review;
        $this->visitor = $visitor;
    }
}

?>
