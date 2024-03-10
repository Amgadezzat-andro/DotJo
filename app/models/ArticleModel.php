<?php
namespace PHPMVC\models;


use PDO;

class ArticleModel extends AbstractModel
{
 
    public $id;
    public $title;
    public $pic;
    public $desc;
    public $cat_id;
    public $pageNum;
    protected $table_name = 'articles'; 


    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT articles.*,categories.category_name as category_name FROM articles 
                                         INNER JOIN categories ON articles.cat_id = categories.id ORDER BY articles.id DESC LIMIT 3");
        if (!empty($_REQUEST['category_name'])) {
            $stmt = $this->db
                ->prepare("SELECT articles.*,categories.category_name as category_name
                                        FROM articles 
                                        INNER JOIN categories ON articles.cat_id = categories.id 
                                        WHERE articles.cat_id =" . $_REQUEST['category_name']);
        }
        if (!empty($this->pageNum)) {
            $stmt = $this->db
                ->prepare("SELECT articles.*,categories.category_name as category_name
                              FROM articles 
                              INNER JOIN categories ON articles.cat_id = categories.id
                              ORDER BY articles.id DESC
                              LIMIT 3 OFFSET " . ($this->pageNum * 3));
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function CountRows()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM articles");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create()
    {
        $stmt = $this->db->prepare("INSERT INTO articles (article_title,article_pic,article_desc,cat_id) VALUES (:title, :pic, :desc, :cat_id)");
        $stmt->bindValue(':title', $this->title);
        $stmt->bindValue(':pic', $this->pic);
        $stmt->bindValue(':desc', $this->desc);
        $stmt->bindValue(':cat_id', $this->cat_id);
        if ($stmt->execute()) {
            return true;
        }

    }
    public function update()
    {
        $stmt = $this->db->prepare("UPDATE articles SET article_title = :title , article_pic = :pic , article_desc = :desc, cat_id = :cat_id WHERE id = :id");
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $this->title);
        $stmt->bindValue(':pic', $this->pic);
        $stmt->bindValue(':desc', $this->desc);
        $stmt->bindValue(':cat_id', $this->cat_id);
        $stmt->execute();
        if ($stmt->execute()) {
            return true;
        }


    }





}