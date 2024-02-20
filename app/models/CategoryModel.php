<?php
namespace PHPMVC\models;

use PDO;
use PHPMVC\lib\database\Database;

class CategoryModel
{
    private $db;
    public $id;
    public $category_name;


    public function __construct()
    {
        $db = new Database();
        $db->connect();
        $this->db = $db->getPDO();
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function fetchCategoryById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create()
    {
        $stmt = $this->db->prepare("INSERT INTO categories (category_name) VALUES (:name)");
        $stmt->bindValue(':name', $this->category_name);
        if ($stmt->execute()) {
            return true;
        }
    }
    public function update()
    {
        $stmt = $this->db->prepare("UPDATE categories SET category_name = :name WHERE id = :id");
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $this->category_name);
        if ($stmt->execute()) {
            return true;
        }
    }

    public function delete()
    {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindValue(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        }
    }



}