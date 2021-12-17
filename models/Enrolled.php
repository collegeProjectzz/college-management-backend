<?php

class Enrolled
{
    private $conn;

    public $date;
    public $rollNo;
    public $cId;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
