<?php
namespace PHPMVC\controllers;

use PHPMVC\LIB\FrontController;

class AbstractController
{
    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_template;
    protected $_data = [];


    public function setController($controllerName)
    {
        $this->_controller = $controllerName;
    }
    public function setAction($actionName)
    {
        $this->_action = $actionName;
    }
    public function setParams($params)
    {
        $this->_params = $params;
    }
    public function setTemplate($template)
    {
        $this->_template = $template;
    }

    public function NotFoundAction()
    {
        $this->_view();
    }


    protected function _view()
    {
        // ** There is no Contorller 
        if ($this->_action == FrontController::NOT_FOUND_ACTION) {
            require_once(VIEWS_PATH . 'notfound' . DS . 'notfound.view.php');
        }
        // ** There is A Controller & Action
        else {
            $view = VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php';
            if (file_exists($view)) {                
                $this->_template->setActionViewFile($view);
                $this->_data = array_merge($this->_data);
                $this->_template->setAppData($this->_data);
                $this->_template->renderApp();
            }
            // ** There is A Controller & Action But No view 
            else {
                require_once(VIEWS_PATH . 'notfound' . DS . 'noview.view.php');

            }
        }

    }




}