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
        $sql = "SELECT * FROM Exam JOIN Course ON Course.cId=Exam.cId JOIN Students ON Students.rollNo = Exam.rollNo;";
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

    public function insertITMarks()
    {
        $sql = "
        UPDATE 
            Exam 
        SET 
            cId=:cId,
            it1=:it1,
            it2=:it2 
        WHERE rollNo=:rollNo;";

        $statement = $this->conn->prepare($sql);

        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));
        $this->cId = htmlspecialchars(strip_tags($this->cId));
        $this->it1 = htmlspecialchars(strip_tags($this->it1));
        $this->it2 = htmlspecialchars(strip_tags($this->it2));

        $statement->bindParam(':rollNo', $this->rollNo);
        $statement->bindParam(':cId', $this->cId);
        $statement->bindParam(':it1', $this->it1);
        $statement->bindParam(':it2', $this->it2);

        if ($statement->execute()) {
            return true;
        };
        printf("Error: %s \n", $statement->error);
        return false;
    }
}
