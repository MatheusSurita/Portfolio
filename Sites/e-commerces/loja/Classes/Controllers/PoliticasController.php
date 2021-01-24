<?php

class PoliticasController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $categories = new Categories();

        $dados = array('erro' => '');

        $dados['categories'] = $categories->getList();

        $this->loadTemplate('Politicas', $dados);
    }
   
}

