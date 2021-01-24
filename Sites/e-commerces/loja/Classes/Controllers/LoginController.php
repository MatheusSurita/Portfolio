<?php

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $Logado = new Cadastro();
        $Logado->VerificarLogin();

           
        
    }

    public function index()
    {

 
        $dados = array('erro'=>'','user' =>'');

        $Login = new Cadastro();
        

        

        $dados['erro'] = $Login->Login();


            $this->loadView('login', $dados);
        
       
    }


    public function edit($id)
    {

        $U = new users();
        if (!empty($id)) {
            $categories = new Categories();
            $Login = new Cadastro();
            if (!empty($_SESSION['TOWER'])) {
                $id = $_SESSION['TOWER'];
                $dados['user'] = $Login->getUser($id);
                $dados['permission_id'] = $id;
            }


            if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {
             $dados['errorItems'] = $_SESSION['formError'];
                unset($_SESSION['formError']);
            }
            $dados['categories'] = $categories->getList();
            $this->loadTemplate('login_edit',$dados);
        } else {
            header('location:' . BASE_URL);
            exit;
        }
    }
    public function edit_actions()
    {
        $U = new Users();

        if (!empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $cpf = addslashes($_POST['cpf']);
            $email = addslashes($_POST['email']);
            $senha = addslashes(sha1($_POST['senha']));

            $U->edit($id, $nome, $email, $senha,$telefone,$cpf );

            header('location:' . BASE_URL);
            exit;
        } else {
            $_SESSION['formError'] = array('users');
            header('location:' . BASE_URL . 'login/edit');
            exit;
        }
    }


    public function esqueci()
    {


        $dados = array();
        $esqueci = new Cadastro();

        $dados['esqueci'] = $esqueci->Esqueci();

        $this->loadView('esqueci', $dados);
    }

    public function redefinir()
    {


        $dados = array();
        $redefinir = new Cadastro();


        $dados['redefinir'] = $redefinir->Redefinir();


        $this->loadView('redefinir', $dados);
  


  
}
    public function sair()
    {
        unset($_SESSION['TOWER']);
        header("location: ".BASE_URL);
        exit;
    }

}
