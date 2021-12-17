<?php

class Enrolled
{
    private $conn;
    private $table = 'Enrolled';

    public $date;
    public $rollNo;
    public $cId;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
