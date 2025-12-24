<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class Database
{
    private $host = 'localhost';
    private $dbname = 'blog';
    private $user = 'root';
    private $pass = '';
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO(
            "mysql:
                    host=$this->host;
                    dbname=$this->dbname;
                ",
            $this->user,
            $this->pass
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getDB()
    {
        return $this->conn;
    } 
    
}
?>