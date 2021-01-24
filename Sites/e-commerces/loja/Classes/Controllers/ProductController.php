<?php

class ProductController extends Controller
{
    private $user;


    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        header('Location:' .BASE_URL );
    }
    public function open($id)
    {
        $dados = array();
        $products = new Products();
        $categories = new Categories();
        $f =  new Filters();


        $filters = array();
        $offset = 0;
        $limit = 4;

        
        $info = $products->getProductInfo($id);
        if(count($info) > 0) {

            $Login = new Cadastro();
            if (!empty($_SESSION['TOWER'])) {
                $as = $_SESSION['TOWER'];
                $dados['user'] = $Login->getUser($as);
            }

           

        $dados['products_images'] = $products->getImagesByProductsId($id); 
        $dados['product_info'] = $info;
        $dados['categories'] = $categories->getList();
        $dados['list'] = $products->getList($offset, $limit, $filters);
        $dados['filters'] = $f->getFilters($filters);
            //paginaçao
        $dados['filters_selected'] = $filters;
        $dados['totalItems'] = $products->getTotal($filters);
       
       


            $this->loadTemplate('product', $dados);
     }else {
         header('Location:'.BASE_URL);
     }  
    
}
}