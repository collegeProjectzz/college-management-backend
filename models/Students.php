<?php

class Students
{
    private $conn;

    public $rollNo;
    public $name;
    public $email;
    public $phone;
    public $password;
    public $dNo;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registerStudent()
    {
        $sql = "INSERT INTO 
        Students
        SET 
            name=:name,
            email=:email,
            phone=:phone,
            password=:password,
            dNo=:dNo";

        $statement = $this->conn->prepare($sql);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->dNo = htmlspecialchars(strip_tags($this->dNo));

        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':phone', $this->phone);
        $statement->bindParam(':password', $this->password);
        $statement->bindParam(':dNo', $this->dNo);

        if ($statement->execute()) {
            return true;
        };
        printf("Error: %s \n", $statement->error);
        return false;
    }
}
