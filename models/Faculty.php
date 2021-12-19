<?php

class Faculty
{
    private $conn;

    public $fId;
    public $fName;
    public $fEmail;
    public $fPassword;
    public $dNo;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registerFaculty()
    {
        $sql = "
            INSERT INTO Faculty SET
            fName=:fName,
            fEmail=:fEmail,
            dNo=:dNo,
            fPassword=:fPassword
        ";

        $statement = $this->conn->prepare($sql);

        $this->fName = htmlspecialchars(strip_tags($this->fName));
        $this->fEmail = htmlspecialchars(strip_tags($this->fEmail));
        $this->dNo = htmlspecialchars(strip_tags($this->dNo));
        $this->fPassword = htmlspecialchars(strip_tags($this->fPassword));

        $statement->bindParam(':fName', $this->fName);
        $statement->bindParam(':fEmail', $this->fEmail);
        $statement->bindParam(':dNo', $this->dNo);
        $statement->bindParam(':fPassword', $this->fPassword);

        if ($statement->execute()) {
            return true;
        };
        printf("Error: %s \n", $statement->error);
        return false;
    }

    public function loginFaculty()
    {
        $sql = "SELECT * FROM  Faculty WHERE fEmail=:fEmail and fPassword=:fPassword";

        $statement = $this->conn->prepare($sql);

        $this->fEmail = htmlspecialchars(strip_tags($this->fEmail));
        $this->fPassword = htmlspecialchars(strip_tags($this->fPassword));

        $statement->bindParam(':fEmail', $this->fEmail);
        $statement->bindParam(':fPassword', $this->fPassword);

        $statement->execute();

        return $statement;
    }

    public function editFaculty()
    {
        $sql = "
            UPDATE 
                Faculty 
            SET 
                fName=:fName,
                fEmail=:fEmail,
                fPassword=:fPassword,
                dNo=:dNo
            WHERE 
                fId=:fId;
        ";

        $stmt = $this->conn->prepare($sql);

        $this->fName = htmlspecialchars(strip_tags($this->fName));
        $this->fEmail = htmlspecialchars(strip_tags($this->fEmail));
        $this->fPassword = htmlspecialchars(strip_tags($this->fPassword));
        $this->dNo = htmlspecialchars(strip_tags($this->dNo));
        $this->fId = htmlspecialchars(strip_tags($this->fId));

        $stmt->bindParam(':fName', $this->fName);
        $stmt->bindParam(':fEmail', $this->fEmail);
        $stmt->bindParam(':fPassword', $this->fPassword);
        $stmt->bindParam(':dNo', $this->dNo);
        $stmt->bindParam(':fId', $this->fId);

        if ($stmt->execute()) {
            return true;
        };
        printf("Error: %s \n", $stmt->error);
        return false;
    }

    public function getSingleFaculty($fId)
    {
        $sql = "SELECT * FROM Faculty WHERE fId=$fId;";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->fId = $row['fId'];
        $this->fName = $row['fName'];
        $this->fEmail = $row['fEmail'];
        $this->dNo = $row['dNo'];
    }
}
