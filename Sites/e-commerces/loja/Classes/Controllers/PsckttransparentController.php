<?php

class PsckttransparentController extends Controller
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
        $products = new Products();
        $categories = new Categories();
      

  
   
        $dados['categories'] = $categories->getList();



        $this->loadTemplate('cart_psckttransparent', $dados);
    }

  
}
