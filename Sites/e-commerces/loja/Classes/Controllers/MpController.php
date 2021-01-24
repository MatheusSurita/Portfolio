<?php 

class MpController extends Controller
{
private $user;

public function __construct()
{
parent::__construct();
}


public function index()
{
        $cart = new Cart();
        $dados = array();
        $users = new Users();
        $purchase = new Purchases();
        $Login = new Cadastro();

        $products = new Products();
        $categories = new Categories();


        if (!empty($_SESSION['TOWER'])) {
            $id = $_SESSION['TOWER'];
            $dados['user'] = $Login->getUser($id);
        }

        if(!empty($_post['name'])){
        $nome = addslashes($_POST['nome']);
        $cpf = addslashes($_POST['cpf']);
        $email = addslashes($_POST['email']);
        $telefone = addslashes($_POST['telefone']);
        $senha = addslashes($_POST['senha']);
        $cep = addslashes($_POST['cep']);
        $rua = addslashes($_POST['rua']);
        $numero = addslashes($_POST['numero']);
        $complemento = addslashes($_POST['complemento']);
        $bairro = addslashes($_POST['bairro']);
        $cidade = addslashes($_POST['cidade']);
        $estado = addslashes($_POST['estado']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $dados['error'] = '<div class="error">Email invalido!!</div>';
            }

               


        if ($users->emailExists($email)) {
                $uid = $users->validate($email, $senha);

                if (empty($uid)) {
                    $dados['error']='<div class="error">E-mail e/ou senha nao conferem.</div>';
                  
                }
            } else {
                $users->createUser($nome, $email, $senha);
            }

            if(!empty($uid)){

                $list = $cart->getList();
                $frete = 0;
                $total = 0;

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

            }

                $id_purchase = $purchase->createPurchase($uid, $total, 'psckttransparente');

                foreach ($list as $item) {
                    $purchase->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
                }

                global $config;
                $mp = new MP($config['mp_appid'], $config['mp_key']);

                $data = array(
                    'items' => array(),
                    'shipements' => array(
                        'mode' => 'custom',
                        'cost' => $frete,
                        'receiver_address' => array(
                            'zip_code' => $cep
                        )
                    ),
                    'back_urls' => array(
                        'success' => 'http://localhost/loja/mp/obrigado',
                        'pending' => 'http://localhost/loja/mp/obrigadoanalise',
                        'failure' => 'http://localhost/loja/mp/cancelada'
                    ),
                    'nofication_url' => 'http://localhost/loja/mp/notificacao',
                    'auto_return' => 'all',
                    'external_reference' => $id_purchase
            );
             
              foreach ($list as $item){
                  $data['items'][] = array(
                          'title' => $item['name'],
                        'quantity' => $item['qt'],
                        'currecy_id' => 'BRL',
                        'unit_price' => floatval($item['price'])
                   );
              }

              $link = $mp->create_preference($data);

              if($link['status'] == '201'){
                  $link = $link['response']['init_point'];
                  header("Location: ".$link);
                  exit;
              }else{
                  $dados['error'] = 'Tente novamente mais tarde';
              }

            }

        }

        $dados['categories'] = $categories->getList();


        $this->loadTemplate('cart_mp', $dados);

}

public function notificacao()
{
        global $config;
        $purchase = new Purchases();
        $mp = new MP($config['mp_appid'], $config['mp_key']);
        $mp->sandbox_mode(false );

        $info = $mp->get_payment_info($_GET['id']);
        if($info['status'] == '200'){
            $array = $info['response'];
            $ref = $array['collection']['externalreference'];
            $status = $array['collection']['status'];
            /*peding  = em analise
            approved = Aprovado
            in_process = emrevisao
            inmediation = em processo de disputa
            rejected = foi rejeitado
            cancelled = cancelado 
            refunded = reembolsado
            charge_back =  Chargeback
            */

            if ($status == 'approved') {
                $purchase->setPaid($ref);
            }else if($status = 'cancelled'){
                $purchase->setCancelled($ref);

            }
        }
}
}