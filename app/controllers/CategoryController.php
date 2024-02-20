<?php
namespace PHPMVC\controllers;


use PHPMVC\lib\InputFilter;
use PHPMVC\lib\Helper;
use PHPMVC\models\CategoryModel;

class CategoryController extends AbstractController
{
    use InputFilter;
    use Helper;


    public function defaultAction()
    {
        $catModel = new CategoryModel();
        $this->_data["categories"] = $catModel->getAll();
        $this->_view();

    }
    public function addAction()
    {
 
        if (isset($_POST['submit'])) {
            $cat = new CategoryModel();
            $cat->category_name = $this->filterString($_POST['category_name']);
            if ($cat->create()) {
                $_SESSION['message'] = "Category , Created Successfully";
                $this->redirect('/category');
            }
        }
        $this->_view();

    }

    public function editAction()
    {

        $id = $this->filterInteger($this->_params[0]);

        $cat = new CategoryModel();
        $cat->id = $id;

        if(!$cat->fetchCategoryById($cat->id)){
            $_SESSION['message'] = "Category Does not Exist";
            $this->redirect('/category');
        }
        
        $this->_data['category'] =  $cat->fetchCategoryById($id); 
        
        if (isset($_POST['submit'])) {
            $cat->category_name = $this->filterString($_POST['category_name']);
            if ($cat->update()) {
                $_SESSION['message'] = "Category , Updated Successfully";
                $this->redirect('/category');
            }
        }
        $this->_view();

    }

    public function deleteAction()
    {
        
        $id = $this->filterInteger($this->_params[0]);

        
        $cat = new CategoryModel();
        $cat_to_delete = $cat->fetchCategoryById($id);
        
        if ($cat_to_delete === false) {
            $this->redirect('/category');
        }
        $cat->id = $cat_to_delete->id;

        if ($cat->delete()) {
            $_SESSION['message'] = "Category , Deleted Successfully";
            $this->redirect('/category');
        }


    }

}