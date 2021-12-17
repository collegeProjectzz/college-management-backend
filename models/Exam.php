<?php

class Exam
{
    private $conn;

    public $rollNo;
    public $cId;
    public $it1;
    public $it2;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllStudentMarks()
    {
        $sql = "SELECT * FROM Exam";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        return $statement;
    }

    public function getStudentMarks()
    {
        $sql = "SELECT * FROM Exam WHERE rollNo=:rollNo";
        $statement = $this->conn->prepare($sql);
        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));
        $statement->bindParam(':rollNo', $this->rollNo);
        $statement->execute();
        return $statement;
    }
}
