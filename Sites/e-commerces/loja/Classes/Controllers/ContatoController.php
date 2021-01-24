<?php

class ContatoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $dados = array('erro' => '');

   
        $this->loadView('contato', $dados);
    }
    public function enviarEmail()
    {
        $contato = new Contato();
    
           if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $mensagem = $_POST['mensagem'];
            $contato->sendMail($nome,$email,$mensagem);

            header('Location:'.BASE_URL);}
            exit; 
        }
        
    }
