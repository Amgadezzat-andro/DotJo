<?php
namespace PHPMVC\controllers;


use PHPMVC\lib\InputFilter;
use PHPMVC\lib\Helper;
use PHPMVC\models\ArticleModel;
use PHPMVC\models\CategoryModel;

class ArticleController extends AbstractController
{
    use InputFilter;
    use Helper;


    public function defaultAction()
    {
        $artModel = new ArticleModel();
        if (isset($this->_params[0])) {
            $pageNumber = $this->filterInteger($this->_params[0]);
            $artModel->pageNum = $pageNumber;
        }
        $catModel = new CategoryModel();
        $this->_data["articles"] = $artModel->getAll();
        $this->_data["rows_count"] = $artModel->CountRows();
        $this->_data["categories"] = $catModel->getAll();
        $this->_view();



    }
    public function addAction()
    {
        $catModel = new CategoryModel();
        if (isset($_POST['submit'])) {
            if (isset($_FILES['article_pic']['name']) && $_FILES['article_pic']['name'] != "") {
                // Get Image Name
                $image = $_FILES['article_pic']['name'];
                // Get Image Extension
                $tmp = explode('.', $image);
                $ext = end($tmp);
                // Rename the Image
                $image = "Article_Image" . rand(000, 999) . '.' . $ext;
                // Get Source Path
                $source_path = $_FILES['article_pic']['tmp_name'];
                // Set Destination Path
                $destination_path = "../public/upload/article_images/$image";
                // Upload Image
                $upload = move_uploaded_file($source_path, $destination_path);
                // Check if Image is Uploaded or not
                if ($upload == false) {
                    // create session variable
                    $_SESSION['error'] = "<div class = 'error'>Image Can not be uploaded</div>";
                    // Redirect Page
                    $this->redirect('/article');
                }

            } else {
                $image = "";
            }

            $art = new ArticleModel();
            $art->title = $this->filterString($_POST['article_title']);
            $art->pic = $image;
            $art->desc = $this->filterString($_POST['article_desc']);
            $art->cat_id = $this->filterInteger($_POST['cat_id']);
            if ($art->create()) {
                $_SESSION['message'] = "Article , Created Successfully";
                $this->redirect('/article');
            }
        }
        $this->_data["categories"] = $catModel->getAll();
        $this->_view();

    }

    public function editAction()
    {
        $catModel = new CategoryModel();

        $id = $this->filterInteger($this->_params[0]);
        $art = new ArticleModel();
        $art->id = $id;

        if (!$art->fetchArticleById($art->id)) {
            $_SESSION['message'] = "Article Does not Exist";
            $this->redirect('/article');
        }

        $this->_data['article'] = $art->fetchArticleById($id);

        if (isset($_POST['submit'])) {

            $current_image = $_POST['current_image'];
            if (isset($_FILES['article_pic']['name']) && $_FILES['article_pic']['name'] != "") {
                // Get Image Name
                $image = $_FILES['article_pic']['name'];
                // Get Image Extension
                $tmp = explode('.', $image);
                $ext = end($tmp);
                // Rename the Image
                $image = "Article_Image" . rand(000, 999) . '.' . $ext;
                // Get Source Path
                $source_path = $_FILES['article_pic']['tmp_name'];
                // Set Destination Path
                $destination_path = "../public/upload/article_images/$image";
                // Upload Image
                $upload = move_uploaded_file($source_path, $destination_path);
                // Check if Image is Uploaded or not
                if ($upload == false) {
                    // create session variable
                    $_SESSION['error'] = "<div class = 'error'>Image Can not be uploaded</div>";
                    // Redirect Page
                    $this->redirect('/article');
                }
                if ($current_image != '') {
                    $remove = unlink("../public/upload/article_images/$current_image");
                    if ($remove == false) {
                        // create session variable
                        $_SESSION['error'] = "<div class = 'error'>Can not Complete Update </div>";
                        // Redirect Page
                        $this->redirect('/article');
                        // Stop The Process
                        die();
                    }
                }

            } else {
                $image = $current_image;
            }
            $art->title = $this->filterString($_POST['article_title']);
            $art->pic = $image;
            $art->desc = $this->filterString($_POST['article_desc']);
            $art->cat_id = $this->filterInteger($_POST['cat_id']);
            if ($art->update()) {
                $_SESSION['message'] = "Article , Updated Successfully";
                $this->redirect('/article');
            }
        }
        $this->_data["categories"] = $catModel->getAll();
        $this->_view();

    }

    public function deleteAction()
    {

        $id = $this->filterInteger($this->_params[0]);


        $art = new ArticleModel();
        $art_to_delete = $art->fetchArticleById($id);

        if ($art_to_delete === false) {
            $this->redirect('/article');
        }
        $art->id = $art_to_delete->id;

        $image_name = $art_to_delete->article_pic;


        if ($image_name != "") {
            $path = "../public/upload/article_images/$image_name";
            $remove = unlink($path);
            if ($remove == false) {
                $_SESSION['error'] = "<div class='error' >Failed To  Delete This Article, Try Again !</div>";
                $this->redirect('/article');
            }
        }

        if ($art->delete()) {
            $_SESSION['message'] = "Article , Deleted Successfully";
            $this->redirect('/article');
        }


    }

    public function viewAction()
    {

        $id = $this->filterInteger($this->_params[0]);
        $art = new ArticleModel();
        $art->id = $id;

        if (!$art->fetchArticleById($art->id)) {
            $_SESSION['message'] = "Article Does not Exist";
            $this->redirect('/article');
        }

        $this->_data['article'] = $art->fetchArticleById($id);
        return $this->_view();
    }

}