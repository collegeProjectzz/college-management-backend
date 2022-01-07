<?php

class Enroll
{
    private $conn;
    public $rollNo;
    public $cId;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function enrollStudent()
    {
        $sql = "
            INSERT INTO
                ENROLL 
            VALUES(
                rollNo=:rollNo;
                cId:=cId
            );
        ";
        $stmt = $this->conn->prepare($sql);

        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));
        $this->cId = htmlspecialchars(strip_tags($this->cId));


        $stmt->bindParam(':rollNo', $this->rollNo);
        $stmt->bindParam(':cId', $this->cId);


        if ($stmt->execute()) {
            return true;
        };

        printf("Error: %s \n", $stmt->error);
        return false;
    }
}
