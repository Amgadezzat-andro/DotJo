<?php
namespace PHPMVC\models;

use PDO;

class SubcategoryModel extends AbstractModel
{

    public $id;
    public $subCategoryName;
    public $category_id;
    protected $table_name = 'sub_category';

    

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT sub_category.* , categories.category_name as category_name
                                    FROM sub_category 
                                    INNER JOIN categories ON sub_category.cat_id = categories.id 
                                    ORDER BY sub_category.id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getCategories()
    {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function create()
    {
        $stmt = $this->db->prepare("INSERT INTO sub_category (name,cat_id) VALUES (:name,:cat_id)");
        $stmt->bindValue(':name', $this->subCategoryName);
        $stmt->bindValue(':cat_id', $this->category_id);
        if ($stmt->execute()) {
            return true;
        }
    }
    public function update()
    {
        $stmt = $this->db->prepare("UPDATE sub_category SET name = :name , cat_id = :cat_id WHERE id = :id");
        $stmt->bindValue(':id', $this->id);
        $stmt->bindValue(':name', $this->subCategoryName);
        $stmt->bindValue(':cat_id', $this->category_id);
        if ($stmt->execute()) {
            return true;
        }
    }

}