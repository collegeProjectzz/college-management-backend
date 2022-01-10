<?php

class Course
{
    private $conn;

    public $cId;
    public $cName;
    public $credit;
    public $fId;
    public $sem;
    public $dNo;

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

    public function getCurrentSemDeptCourses()
    {
        $sql = "SELECT * FROM Students JOIN Course ON Students.dNo=Course.dNo WHERE Students.sem=Course.sem AND Students.sem=:sem AND Students.dNo=:dNo;";
        $statement = $this->conn->prepare($sql);
        $this->sem = htmlspecialchars(strip_tags($this->sem));
        $statement->bindParam(':sem', $this->sem);
        $this->dNo = htmlspecialchars(strip_tags($this->dNo));
        $statement->bindParam(':dNo', $this->dNo);
        $statement->execute();
        return $statement;
    }
}
