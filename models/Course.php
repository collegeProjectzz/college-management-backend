<?php

class Course
{
    private $conn;

    public $cId;
    public $cName;
    public $credit;
    public $fId;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllCourses()
    {
        $sql = "SELECT * FROM Course;";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        return $statement;
    }
    
}
