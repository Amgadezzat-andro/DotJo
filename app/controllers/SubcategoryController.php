<?php
namespace PHPMVC\controllers;


use PHPMVC\lib\InputFilter;
use PHPMVC\lib\Helper;
use PHPMVC\models\CategoryModel;
use PHPMVC\models\SubcategoryModel;

class SubcategoryController extends AbstractController
{
    use InputFilter;
    use Helper;


    public function defaultAction()
    {
        $scatModel = new SubcategoryModel();
        $this->_data["scategories"] = $scatModel->getAll();
        $this->_view();
    }

    public function addAction()
    {
        $cat = new CategoryModel();
        $this->_data['categories'] = $cat->getAll();
        if (isset($_POST['submit'])) {
            $cat = new SubcategoryModel();
            $cat->subCategoryName = $this->filterString($_POST['scategory_name']);
            $cat->category_id = $this->filterInteger($_POST['cat_id']);
            if ($cat->create()) {
                $_SESSION['message'] = "Sub Category , Created Successfully";
                $this->redirect('/subcategory');
            }
        }
        $this->_view();

    }

    public function editAction()
    {

        $id = $this->filterInteger($this->_params[0]);
        $cat = new CategoryModel();
        $scat = new SubcategoryModel();
        $scat->id = $id;

        if (!$scat->getByID($scat->id)) {
            $_SESSION['message'] = "SubCategory Does not Exist";
            $this->redirect('/subcategory');
        }

        $this->_data['scategory'] = $scat->getByID($id);
        $this->_data['categories'] = $cat->getAll();

        if (isset($_POST['submit'])) {
            $scat->subCategoryName = $this->filterString($_POST['scategory_name']);
            $scat->category_id = $this->filterInteger($_POST['cat_id']);
            if ($scat->update()) {
                $_SESSION['message'] = "SubCategory , Updated Successfully";
                $this->redirect('/subcategory');
            }
        }
        $this->_view();

    }

    public function deleteAction()
    {

        $id = $this->filterInteger($this->_params[0]);

        $cat = new SubcategoryModel();
        $cat_to_delete = $cat->getByID($id);

        if ($cat_to_delete === false) {
            $this->redirect('/subcategory');
        }

        if ($cat->delete($cat_to_delete->id)) {
            $_SESSION['message'] = "SubCategory , Deleted Successfully";
            $this->redirect('/subcategory');
        } else {
            $_SESSION['message'] = "Some Error Happend!! Some Articles are attached to this Subcategory";
            $this->redirect('/subcategory');
        }


    }

    public function getsubcategoriesAction()
    {
        if (isset($_GET['var1'])) {
            $category_id = $_GET['var1'];
            $cat = new SubcategoryModel();
            $scategories = $cat->getSubCategoriesByCategoryID($category_id);
            echo <<<'MEGODOC'
        <div class="form-group">
        <label for="articleCategory">Sub Category</label>
        <select name="scat_id" class="form-control">
        MEGODOC;
            echo "<option value='{$scategories[0]->id}'>Click To Choose Sub Categorires</option>";
            foreach ($scategories as $scategory):
                echo "<option value='$scategory->id'>$scategory->name</option>";
            endforeach;
            echo <<<'MEGODOC'
       </select>
       </div>
       MEGODOC;
        }
    }

}