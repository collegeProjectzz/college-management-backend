<?php

class Enroll
{
    private $conn;
    public $date;
    public $rollNo;
    public $cId1;
    public $cid2;
    public $cid3;
    public $cid4;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function enrollStudent()
    {
        $sql = "
            INSERT INTO
                ENROLL 
            SET
                date=:date;
                rollNo=:rollNo;
                cId1:=cId1;
                cid2:=cId2;
                cid3:=cId3;
                cid4:=cId4;
        ";
        $stmt = $this->conn->prepare($sql);

        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));
        $this->cId1 = htmlspecialchars(strip_tags($this->cId1));
        $this->cId2 = htmlspecialchars(strip_tags($this->cId2));
        $this->cId3 = htmlspecialchars(strip_tags($this->cId3));
        $this->cId4 = htmlspecialchars(strip_tags($this->cId4));

        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':rollNo', $this->rollNo);
        $stmt->bindParam(':cId1', $this->cId1);
        $stmt->bindParam(':cId2', $this->cId2);
        $stmt->bindParam(':cId3', $this->cId3);
        $stmt->bindParam(':cId4', $this->cId4);

        if ($stmt->execute()) {
            return true;
        };

        printf("Error: %s \n", $stmt->error);
        return false;
    }
}
