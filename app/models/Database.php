<?php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "crm_oop";
    private $port = "3306";

    public function getConnection()
    {
        $conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname,
            $this->port
        );

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
