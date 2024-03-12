<?php
namespace PHPMVC\models;

use PDO;
use PHPMVC\lib\database\Database;

abstract class AbstractModel
{

    protected $db;
    protected $table_name;

    public function __construct()
    {
        $db = new Database();
        $db->connect();
        $this->db = $db->getPDO();
    }
    public function getByID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table_name WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM $this->table_name WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
        
    }




}