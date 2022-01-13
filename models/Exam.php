<?php
class Exam
{
    private $conn;

    public $rollNo;
    public $cId;
    public $it1;
    public $it2;
    public $it3;
    public $sem;
    public $total;
    public $avg;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insertRollNo($rollNo, $cId, $sem)
    {

        $sql = "INSERT INTO Exam SET it1='-',it2='-',it3='-',total='-',avg='-',sem=$sem,cId=$cId,rollNo=$rollNo";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            return true;
        };
        printf("Error: %s \n", $stmt->error);
        return false;
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
        $sql = "SELECT * FROM Exam JOIN Course ON Course.cId=Exam.cId JOIN Students ON Students.rollNo = Exam.rollNo WHERE Students.rollNo=:rollNo AND Exam.sem=:sem;";
        $statement = $this->conn->prepare($sql);
        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));
        $statement->bindParam(':rollNo', $this->rollNo);
        $this->sem = htmlspecialchars(strip_tags($this->sem));
        $statement->bindParam(':sem', $this->sem);
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
            sem=:sem,
            it1=:it1,
            it2=:it2, 
            it3=:it3, 
            total=:total, 
            avg=:avg, 
            rollNo=:rollNo
        ";

        $stmt = $this->conn->prepare($sql);

        $this->cId = htmlspecialchars(strip_tags($this->cId));
        $this->sem = htmlspecialchars(strip_tags($this->sem));
        $this->it1 = htmlspecialchars(strip_tags($this->it1));
        $this->it2 = htmlspecialchars(strip_tags($this->it2));
        $this->it3 = htmlspecialchars(strip_tags($this->it3));
        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));
        $this->total = htmlspecialchars(strip_tags($this->total));
        $this->avg = htmlspecialchars(strip_tags($this->avg));

        $stmt->bindParam(':cId', $this->cId);
        $stmt->bindParam(':sem', $this->sem);
        $stmt->bindParam(':it1', $this->it1);
        $stmt->bindParam(':it2', $this->it2);
        $stmt->bindParam(':it3', $this->it3);
        $stmt->bindParam(':rollNo', $this->rollNo);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':avg', $this->avg);

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
                it2=:it2,
                it3=:it3,
                total=:total, 
                avg=:avg
            WHERE 
                rollNo=:rollNo and cId=:cId;
        ";

        $stmt = $this->conn->prepare($sql);

        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));
        $this->cId = htmlspecialchars(strip_tags($this->cId));
        $this->it1 = htmlspecialchars(strip_tags($this->it1));
        $this->it2 = htmlspecialchars(strip_tags($this->it2));
        $this->it3 = htmlspecialchars(strip_tags($this->it3));
        $this->total = htmlspecialchars(strip_tags($this->total));
        $this->avg = htmlspecialchars(strip_tags($this->avg));

        $stmt->bindParam(':rollNo', $this->rollNo);
        $stmt->bindParam(':cId', $this->cId);
        $stmt->bindParam(':it1', $this->it1);
        $stmt->bindParam(':it2', $this->it2);
        $stmt->bindParam(':it3', $this->it3);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':avg', $this->avg);

        if ($stmt->execute()) {
            return true;
        };
        printf("Error: %s \n", $stmt->error);
        return false;
    }

    public function SudentsIncourse()
    {
        $sql = "SELECT * FROM Exam JOIN Students ON Exam.rollNo=Students.rollNo WHERE Exam.cId=:cId;";
        $statement = $this->conn->prepare($sql);
        $this->cId = htmlspecialchars(strip_tags($this->cId));
        $statement->bindParam(':cId', $this->cId);
        $statement->execute();
        return $statement;
    }
}
