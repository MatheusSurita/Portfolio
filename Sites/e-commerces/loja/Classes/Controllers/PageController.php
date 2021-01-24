<?php

class PageController extends Controller
{
    private $user;


    public function __construct()
    {
        parent::__construct();
    }
 
    public function index() {
        header('Location:' . BASE_URL);}

    public function enter($id)
    {
        $gamecat =new Gamecat();
        $dados = array();
        $products = new Products();
        $categories = new Categories();
        $f =  new Filters();

        $Login = new Cadastro();
        if (!empty($_SESSION['TOWER'])) {
            $id = $_SESSION['TOWER'];
            $dados['user'] = $Login->getUser($id);
            $dados['permission_id'] = $id;
        }

        $dados['category_name'] = $categories->getCategoryName($id);

        if(!empty($dados['category_name'])) {
            $dados['categorys_id'] = $categories->getCategoryId($id);
        
        $currentPage = 1;
        $offset = 0;
        $limit = 12;
        $dados['category_filter'] = $categories->getCategoryTree($id);
       

                if (!empty($_GET['p'])) {
                    $currentPage = $_GET['p'];
                }
                $offset = ($currentPage * $limit) - $limit;
        
       

                $filters = array('category' => $id);
                
                if(!empty($_GET['filter']) && is_array($_GET['filter'])) {
                    $filters = $_GET['filter'];
                }
            $filters['searchTerm'] = '';
            $filters['category'] = $id;
         
            $dados['filters'] = $f->getFilters($filters);
            $dados['list'] = $products->getList($offset, $limit, $filters);
            $dados['filters_selected'] = $filters;
            $dados['searchTerm'] = '';
            $dados['category'] = $id;
          
        $dados['totalItems'] = $products->getTotal($filters);
        $dados['numberOfPages'] = ceil($dados['totalItems'] / $limit);
        $dados['currentPage'] = $currentPage;
          
            

        $dados['categories'] = $categories->getList();
        
        $this->loadTemplate('page', $dados);
  
}else{
            header('Location:' .BASE_URL);
        }
    

}
}