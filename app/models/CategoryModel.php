<?php
namespace PHPMVC\models;

use PDO;

class CategoryModel extends AbstractModel
{

    public $id;
    public $category_name;
    protected $table_name = 'categories';

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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

    // TODO: Make it Static 
    // public static function getByID2($id)
    // {
    //     $stmt = self::$db->prepare("SELECT * FROM " . self::$table_name . " WHERE id = :id");
    //     $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    //     $stmt->execute();
    //     return $stmt->fetchObject(__CLASS__);
    // }




}