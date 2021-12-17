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

    public function loginStudent()
    {
        $sql = "SELECT * FROM  Students WHERE email=:email and password=:password";

        $statement = $this->conn->prepare($sql);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $statement->bindParam(':email', $this->email);
        $statement->bindParam(':password', $this->password);

        $statement->execute();

        return $statement;
    }

    public function editStudent()
    {
        $sql = "
            UPDATE 
                Students 
            SET 
                name=:name,
                email=:email,
                phone=:phone,
                password=:password,
                dNo=:dNo
            WHERE 
                rollNo=:rollNo;
        ";

        $stmt = $this->conn->prepare($sql);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->dNo = htmlspecialchars(strip_tags($this->dNo));
        $this->rollNo = htmlspecialchars(strip_tags($this->rollNo));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':dNo', $this->dNo);
        $stmt->bindParam(':rollNo', $this->rollNo);

        if ($stmt->execute()) {
            return true;
        };
        printf("Error: %s \n", $stmt->error);
        return false;
    }
}
