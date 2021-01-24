<?php

class SuporteController extends Controller
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

        $this->loadTemplate('Suporte', $dados);
    }
    public function enviarEmail()
    {
        $Suporte = new Contato();

        if (!empty($_POST['nome'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $mensagem = $_POST['mensagem'];
            $Suporte->sendMail($nome, $email, $mensagem);

            header('Location:' . BASE_URL);
        }
        exit;
    }
}
