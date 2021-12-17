<?php

class Exam
{
    private $conn;
    private $table = 'Exam';

    public $rollNo;
    public $cId;
    public $it1;
    public $it2;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
