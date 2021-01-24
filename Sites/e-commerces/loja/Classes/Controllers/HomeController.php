<?php

class HomeController extends Controller
{   private $user;

    

   public function __construct()
   {
       parent::__construct();
       
   }
    

    public function index(){
        $dados = array();
        $products = new Products();
        $categories = new Categories();
        $f = new Filters();
        $currentPage = 1;
        $offset = 0;
        $limit = 8;
 
        $filters = array();
        if(!empty($_GET['filter'] )&& is_array($_GET['filter']))
        {
        $filters = $_GET['filter'];
        }

        $Login = new Cadastro();
        if (!empty($_SESSION['TOWER'])) {
            $id = $_SESSION['TOWER'];
            $dados['user'] = $Login->getUser($id);
        }
        
       if (!empty($_get['p'])){
            $currentPage = $_GET['p'];
        }
    
        $dados['widget_new'] = $products->getList(0 ,12,array('new_products' => '1'),true);
        $dados['widget_bestseller'] = $products->getList(0, 12, array('bestseller' => '1'),true);

        //paginaçao
        

        $dados['list'] = $products->getList($offset, $limit, $filters);
        $dados['filters'] = $f->getFilters($filters);
        $dados['totalItems'] = $products->getTotal($filters);
        $dados['numberOfPages'] = ceil($dados['totalItems'] / $limit); 
        $dados['currentPage'] = $currentPage;
        $dados['categories'] = $categories->getList();

        $this->loadTemplate('home',$dados);
    }

}
    
