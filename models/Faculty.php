<?php

class Faculty
{
    private $conn;

    public $fId;
    public $fName;
    public $fEmail;
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
            dNo=:dNo
        ";

        $statement = $this->conn->prepare($sql);

        $this->fName = htmlspecialchars(strip_tags($this->fName));
        $this->fEmail = htmlspecialchars(strip_tags($this->fEmail));
        $this->dNo = htmlspecialchars(strip_tags($this->dNo));

        $statement->bindParam(':fName', $this->fName);
        $statement->bindParam(':fEmail', $this->fEmail);
        $statement->bindParam(':dNo', $this->dNo);

        if ($statement->execute()) {
            return true;
        };
        printf("Error: %s \n", $statement->error);
        return false;
    }
}
