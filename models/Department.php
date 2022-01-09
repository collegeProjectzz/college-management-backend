<?php

class Department
{
    private $conn;

    public $dNo;
    public $dName;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllDepartment()
    {
        $sql = "SELECT * FROM Department;";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        return $statement;
    }
}
