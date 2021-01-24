<?php

class BuscaController extends Controller
{
    private $user;


    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $dados = array();
        $products = new Products();
        $categories = new Categories();
        $f =  new Filters();

        if(!empty($_GET['s'])){
            $searchTerm = $_GET['s'];
            $category= $_GET['category'];

            $filters = array();
            if (!empty($_GET['filter']) && is_array($_GET['filter'])) {
                $filters = $_GET['filter'];
            }
            $filters['searchTerm'] = $searchTerm;
            $filters['category'] = $category;

            $currentPage = 1;
            $offset = 0;
            $limit = 12;

            $dados['categorys_id'] = $categories->getCategoryId('$id');

            if (!empty($_GET['p'])) {
                $currentPage = $_GET['p'];
            }

            $offset = ($currentPage * $limit) - $limit;

                    

            $dados['list'] = $products->getList($offset, $limit, $filters);
        

            $dados['categories'] = $categories->getList();
            $dados['totalItems'] = $products->getTotal($filters);
            $dados['numberOfPages'] = ceil($dados['totalItems'] / $limit);

            $dados['filters'] = $f->getFilters($filters);
            $dados['filters_selected'] = $filters;  
            $dados['searchTerm'] = $searchTerm;
            $dados['category'] = $category;


            $this->loadTemplate('busca', $dados);
        } else {
            header('Location:' . BASE_URL);
        }
    }
   
}
