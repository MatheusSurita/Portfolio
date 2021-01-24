<?php
class PsckttransparenteController extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $dados = array();
        $cart = new Cart();
        $purchase = new Purchases();

        $products = new Products();
        $categories = new Categories();

        $list = $cart->getList();
        $subtotal = 0;
        $total = 0;

        $Login = new Cadastro();
        if(!empty($_SESSION['TOWER'])) {
            $id = $_SESSION['TOWER'];
            $dados['user'] = $Login->getUser($id);
        }else{
            $id = '';
            $dados['user'] = $Login->getUser($id);
        }
        
       
        foreach ($list as $item) {

            $total += (floatval($item['price']) * intval($item['qt']));
        }

        if (!empty($_SESSION['shipping'])) {
            $shipping = $_SESSION['shipping'];

           
            if (!empty($shipping['price'])) {
                $frete = floatval(str_replace(',', '.', $shipping['price']));


            } else {
                $frete = 0;
            }
            
            $total += $frete;
            
        }
        $dados['total'] = number_format($total ,2);

        $dados['list'] = $cart->getList();
   
        $dados['categories'] = $categories->getList();


        try {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
            $dados['sessionCode'] = $sessionCode->getResult();
        }catch (Exception $e) {
            echo "Erro : ".$e->getMessage();
            exit;
        }

        $this->loadTemplate('cart_psckttransparente', $dados);
    }

    public function checkout()
    {
                    $cart = new Cart();
                    $users = new Users();
                    $purchase = new Purchases();

                    $id= addslashes($_POST['id']);
                    $nome= addslashes($_POST['nome']);
                    $cpf= addslashes($_POST['cpf']);
                    $email= addslashes($_POST['email']);
                    $telefone = addslashes($_POST['telefone']);
                    $senha= addslashes($_POST['senha']);
                    $cep= addslashes($_POST['cep']);
                    $rua= addslashes($_POST['rua']);
                    $numero= addslashes($_POST['numero']);
                    $complemento= addslashes($_POST['complemento']);
                    $bairro= addslashes($_POST['bairro']);
                    $cidade= addslashes($_POST['cidade']);
                    $estado= addslashes($_POST['estado']);
                    $titularCard= addslashes($_POST['titularCard']);
                    $cpftitularcard= addslashes($_POST['cpftitularcard']);
                    $cartao_numero = addslashes($_POST['cartao_numero']);
                    $cvv= addslashes($_POST['cvv']);
                    $mes= addslashes($_POST['mes']);
                    $ano= addslashes($_POST['ano']);
                    $cartao_token= addslashes($_POST['cartao_token']);
                    $parc= explode(';' , $_POST['parc']);

                   if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $dados['error'] = '<div class="error">Email invalido!!</div>';
                   }

            
       

                   
                    if ($users->emailExists($email)) { 
                        $uid = $users->validate($email , $senha);

                        if(empty($uid)){
                            $dados['error']='<div class="error">E-mail e/ou senha nao conferem.</div>';
                            
                        }
                    }else{
                         $uid = $users->createUser($nome,$email, $senha);
                    }



        
        $list = $cart->getList();
        $total = 0;
        foreach ($list as $item) {

            $total += (floatval($item['price']) * intval($item['qt']));
        }

        if (!empty($_SESSION['shipping'])) {
            $shipping = $_SESSION['shipping'];


            if (!empty($shipping['price'])) {
                $frete = floatval(str_replace(',', '.',$shipping['price']));
            } else {
                $frete = 0;
            }

            $total += $frete;

        }
        $id_purchase = $purchase->createPurchase($uid, $total,'psckttransparente');
    
        foreach ($list as $item) {
           $purchase->addItem($id_purchase, $item['id'], $item['qt'] , $item['price']);
        }


        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        global $config;
        $creditCard->setReceiverEmail($config['pagseguro_seller']);
        $creditCard->setReference($id_purchase);
        $creditCard->setCurrency("BRL");
        foreach ($list as $item) {
            $creditCard->addItems()->withParameters(
                $item['id'],
                $item['name'],
                intval($item['qt']),
                floatval($total)
            );
        }

        $creditCard->setSender()->setName($nome);
        $creditCard->setSender()->setEmail($email);
        $creditCard->setSender()->setDocument()->withParameters('CPF',$cpf);
        
        $ddd = substr($telefone,0,2);
        $telefone = substr($telefone,2);

        $creditCard->setSender()->setPhone()->withParameters(
            $ddd,
            $telefone
        );

        $creditCard->setSender()->setHash($id);

        $ip = $_SERVER['REMOTE_ADDR'];
        if(strlen($ip) < 9 ){
            $ip = '127.0.0.1';
        }
        $creditCard->setSender()->setIp($ip);

        $creditCard->setShipping()->setAddress()->withParameters(
            $rua,
            $numero,
            $bairro,
            $cep,
            $cidade,
            $estado,
            'BRA',
            $complemento
        );

        $creditCard->setBilling()->setAddress()->withParameters(
            $rua,
            $numero,
            $bairro,
            $cep,
            $cidade,
            $estado,
            'BRA',
            $complemento
        );
        
        $creditCard->setToken($cartao_token);
        $creditCard->setHolder()->setName($titularCard);
        $creditCard->setInstallment()->withParameters($parc[0], $parc[1]);
        $creditCard->setHolder()->setDocument()->withParameters('CPF', $cpftitularcard);
        $creditCard->setMode('DEFAULT');
       // $creditCard->setNotificationURL('http://localhost/loja/psckttransparente/notification');*/
        try{
            $result = $creditCard->register(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            echo json_encode($result);
            exit;
        }catch(Exception $e){
            echo json_encode(array('erro'=>true,'msg'=>$e->getMessage()));
            exit;
        }


    
 

    }


 public function obrigado()
 {


    unset($_SESSION['cart']);
        $dados = array();
       
        $categories = new Categories();

        $dados['categories'] = $categories->getList();

        $this->loadTemplate('psckttransparente_obrigado', $dados);

 }   
 public function notification()
 {
     $purchases = new Purchases();
   try {
     if (\PagSeguro\Helpers\Xhr::hasPost()) {
         $r = \PagSeguro\Services\Transactions\Notification::check(
             \PagSeguro\Configuration\Configure::getAccountCredentials()
         );

            $ref = $r->getReference();
            $status = $ref->getStatus();
            /*
            1 = Aguardando Pagamento
            2 = Em Analise
            3 = Paga
            4 = Disponivel
            5 = Em disputa
            6 = Devoluçao
            7 = Cancelada
            8 = Debitado
            9 = Retençao Temporaria = Chargeback
            
            */
            if($status == 3){
                $purchases->setPaid($ref);
            }
            
            else if($status == 7) {
            $purchases->setCancelled($ref);
            } else if ($status == 8) {
            $purchases->setDebited($ref);
            }
}
   } catch (Exception $e) {
       echo 'ERRO: '.$e->getMessage();
   }
 }
  
}
