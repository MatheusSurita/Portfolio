<?php  


class Controller
{   
    protected $db;
    public function __construct()
    {   
    }
    public function loadView($viewName,$viewData = array()){
        extract($viewData);
        require 'Classes/Views/'.$viewName.'.php';
    }
    public function loadTemplate($viewName, $viewData = array())
    {
        require 'Classes/Views/template.php';
    }
    public function loadViewinTemplate($viewName, $viewData = array())
    {
        extract($viewData);
        require 'Classes/Views/'.$viewName.'.php';
    }
}
