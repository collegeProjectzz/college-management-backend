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
        $sql = "SELECT * FROM Exam JOIN Course ON Course.cId=Exam.cId JOIN Students ON Students.rollNo = Exam.rollNo WHERE Students.rollNo=:rollNo;";
        $statement = $this->conn->prepare($sql);
        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));
        $statement->bindParam(':rollNo', $this->rollNo);
        $statement->execute();
        return $statement;
    }

    public function insertItMarks()
    {
        $sql = "
        INSERT INTO 
            Exam
        SET 
            cId=:cId,
            it1=:it1,
            it2=:it2, 
            rollNo=:rollNo
        ";

        $stmt = $this->conn->prepare($sql);

        $this->cId = htmlspecialchars(strip_tags($this->cId));
        $this->it1 = htmlspecialchars(strip_tags($this->it1));
        $this->it2 = htmlspecialchars(strip_tags($this->it2));
        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));

        $stmt->bindParam(':cId', $this->cId);
        $stmt->bindParam(':it1', $this->it1);
        $stmt->bindParam(':it2', $this->it2);
        $stmt->bindParam(':rollNo', $this->rollNo);

        if ($stmt->execute()) {
            return true;
        };

        printf("Error: %s \n", $stmt->error);
        return false;
    }

    public function updateItMarks()
    {
        $sql = "
            UPDATE
                Exam
            SET
                it1=:it1,
                it2=:it2
            WHERE 
                rollNo=:rollNo and cId=:cId;
        ";

        $stmt = $this->conn->prepare($sql);

        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));
        $this->cId = htmlspecialchars(strip_tags($this->cId));
        $this->it1 = htmlspecialchars(strip_tags($this->it1));
        $this->it2 = htmlspecialchars(strip_tags($this->it2));

        $stmt->bindParam(':rollNo', $this->rollNo);
        $stmt->bindParam(':cId', $this->cId);
        $stmt->bindParam(':it1', $this->it1);
        $stmt->bindParam(':it2', $this->it2);

        if ($stmt->execute()) {
            return true;
        };
        printf("Error: %s \n", $stmt->error);
        return false;
    }
}
