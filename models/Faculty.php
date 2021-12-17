<?php

class Faculty
{
    private $conn;
    private $table = 'Faculty';

    public $fId;
    public $fName;
    public $fEmail;
    public $dNo;

    public function __construct($db)
    {
        $this->conn = $db;
    }
}
