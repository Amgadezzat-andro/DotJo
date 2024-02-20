<?php
namespace PHPMVC\controllers;

class IndexController extends AbstractController
{
    // ** Every Controller Extends From Abstract Controller to Have the functions
    // ** of Set Controller , Set Action , Set Params , and _view Function
    // ** also not Found Function

    public function defaultAction()
    {
        $this->_view();
    }

    public function addAction()
    {
        $this->_view();
    }
}