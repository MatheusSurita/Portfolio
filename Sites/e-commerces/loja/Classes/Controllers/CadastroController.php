<?php

class CadastroController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {


            $dados = array('erro' =>'');
            $cadastro = new Cadastro();

            $dados['erro'] = $cadastro->Cadastrar();

            $this->loadView('cadastro', $dados);
        
       
    }
  


  
}
