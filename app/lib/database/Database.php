<?php

namespace PHPMVC\lib\database;

use PDO;
use PDOException;

class Database
{
    private $_host;
    private $_dbname;
    private $_username;
    private $_password;
    private $pdo;

    public function __construct()
    {
        $this->_host = DATABASE_HOST_NAME;
        $this->_dbname = DATABASE_DB_NAME;
        $this->_username = DATABASE_USER_NAME;
        $this->_password = DATABASE_PASSWORD;
    }

    public function connect()
    {
        try {
            $dsn = "mysql:host={$this->_host};dbname={$this->_dbname}";
            $this->pdo = new PDO($dsn, $this->_username, $this->_password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getPDO()
    {   
        return $this->pdo;
    }
}
?>