<?php

class CartController extends Controller
{
    private $user;

   public function __construct()
   {
       parent::__construct();
       
   }
    

    public function index(){
        $dados = array();
        $cart = new Cart();
        $cep = '';
        $products = new Products();
        $categories = new Categories();
        $shipping = array();

        $Login = new Cadastro();
        if (!empty($_SESSION['TOWER'])) {
            $id = $_SESSION['TOWER'];
            $dados['user'] = $Login->getUser($id);
        }
        if(!empty($_POST['cep'])) {
            $cep = intval($_POST['cep']);
   
            $shipping = $cart->shippingCalculate($cep);
            $_SESSION['shipping'] = $shipping;
        }
        if (!empty($_SESSION['shipping'])) {
            $shipping = $_SESSION['shipping'];
        }

        $dados['list'] = $cart->getList();
        $dados['shipping'] = $shipping;
        if(!isset($_SESSION['cart']) || (isset ($_SESSION['cart']) && count($_SESSION['cart']) == 0))
{
    header("Location: ".BASE_URL);
    exit;
}
        $dados['categories'] = $categories->getList();
       
        

        $this->loadTemplate('cart',$dados);
    }

public function removeQt($id){

if (!empty($_SESSION['cart'][$id] > 1)) {
                $_SESSION['cart'][$id] -= 1;
            } else {
            unset($_SESSION['cart'][$id]);
            }
        
        header("location: " . BASE_URL . "cart");
    }

    public function addQt($id)
    { 
         if (!empty($id)) {
            $_SESSION['cart'][$id] += 1;

        }
        header("location: " . BASE_URL . "cart");
    }



    public function payment_redirect()
    {
        if (!empty($_POST['payment_type'])) {
            $payment_type = $_POST['payment_type'];
            switch ($payment_type) {
                case 'checkout_tranparente';
                    header("Location: " .BASE_URL."psckttransparente");
                    exit;
                    break;
                case 'mp';
                    header("Location: " .BASE_URL. "mp");
                    exit;
                    break;
               

                default:
                    # code...
                    break;
            }
        }
        header("Location :" . BASE_URL . "cart");
        exit;
    }


    public function del($id)
    {
        if(!empty($id)|| empty($id)) {
            unset($_SESSION['cart'][$id]);
        }
        header("location: ".BASE_URL."cart");
    }
    public function add(){
       
        if(!empty($_POST['id_product'])) {
        $id = intval($_POST['id_product']);
        $qt = intval($_POST['qtP']);

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
            if(isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] += $qt;
            } else {
                $_SESSION['cart'][$id] = $qt;
            }
            header("Location: ".BASE_URL."product/open/".$id);
            exit;
        }
    }
}