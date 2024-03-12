<?php

namespace PHPMVC\LIB;

class Template
{
    private $_template_parts;
    private $_action_view;
    private $_data;

    public function __construct(array $parts)
    {
        $this->_template_parts = $parts;
    }

    public function setActionViewFile($actionViewPath)
    {
        $this->_action_view = $actionViewPath;

    }
    public function setAppData($data)
    {
        $this->_data = $data;
    }
    private function renderTemplateHeaderStart()
    {
        require_once TEMPLATE_PATH . DS . 'templateheaderstart.php';
    }
    private function renderTemplateHeaderEnd()
    {
        require_once TEMPLATE_PATH . DS . 'templateheaderend.php';
    }
    private function renderTemplateFooter()
    {
        require_once TEMPLATE_PATH . DS . 'templatefooter.php';
    }
    private function renderTemplateBlocks()
    {
        // var_dump($this->_template_parts);
        if (!array_key_exists('template', $this->_template_parts)) {
            trigger_error('Sorry You Have to Define The Template Block', E_USER_WARNING);
        } else {
            $parts = $this->_template_parts['template'];
            if (!empty($parts)) {
                extract($this->_data);
                foreach ($parts as $partKey => $File) {
                    if ($partKey === ':view') {
                        require_once $this->_action_view;
                    } else {
                        require_once $File;

                    }

                }
            }

        }
    }

    private function renderHeaderResources()
    {
        $output = '';
        if (!array_key_exists('header_resources', $this->_template_parts)) {
            trigger_error('Sorry You Have to Define The Header Resources ', E_USER_WARNING);
        } else {
            $resources = $this->_template_parts['header_resources'];


            // Generate CSS Links
            $css = $resources['css'];
            if (!empty($css)) {
                foreach ($css as $cssKey => $path) {
                    $output = '<link rel="stylesheet" href="' . $path . '">';
                    echo $output . "\n";
                }
            }

            // Generate Js Scripts
            $js = $resources['js'];
            if (!empty($js)) {
                foreach ($js as $jsKey => $path) {
                    $output = '<script src ="' . $path . '"></script>';
                    echo $output . "\n";
                }
            }



        }

    }

    private function renderFooterResources()
    {
        $output = '';
        if (!array_key_exists('footer_resources', $this->_template_parts)) {
            trigger_error('Sorry You Have to Define The Footer Resources ', E_USER_WARNING);
        } else {
            $resources = $this->_template_parts['footer_resources'];

            // var_dump($resources);
            // Generate Js Scripts
            $js = $resources['js'];
            if (!empty($js)) {
                foreach ($js as $jsKey => $path) {
                    $output = '<script src ="' . $path . '"></script>';
                    echo $output . "\n";
                }
            }



        }

    }
    public function renderApp()
    {
        $this->renderTemplateHeaderStart(); 
        $this->renderHeaderResources(); 
        $this->renderTemplateHeaderEnd(); 
        $this->renderTemplateBlocks(); 
        $this->renderFooterResources();
        $this->renderTemplateFooter();

    }



}

