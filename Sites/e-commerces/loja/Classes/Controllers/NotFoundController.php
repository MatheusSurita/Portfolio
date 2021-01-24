<?php

class NotFoundController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $dados = array();
        $this->loadview('404',$dados);
    }
  
}
?>