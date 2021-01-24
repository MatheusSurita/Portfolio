<?php 
class Filters extends Model
{
    
public function getFilters($filters)
    {
        $category = new Categories();
        $products = new Products();
        $gamecat = new Gamecat();
       $array = array(
        'category' => '',   
        'searchTerm'=> '',
        'gamecat' => array(),
        'sale'=> 0,
        'bestseller' => 0,
        'new_products' => 0,
        'featured' => 0,
        
        );
 
        $id = ['id_category'];
        
        if(isset($filters['searchTerm'])){
            $array['searchTerm'] = $filters['searchTerm'];
        }

        if (isset($filters['category'])) {
            $array['category'] = $filters['category'];
        }


        $array['gamecat'] = $gamecat->getList();
        $gamecat_product = $products->getListOfGamecat();
        foreach ($array['gamecat'] as $bkey => $bitem) {

            $array['gamecat'][$bkey]['count'] = '0';
            foreach ($gamecat_product as $bproduct) {

                if ($bproduct['id_gamecat'] == $bitem['id']) {

                    $array['gamecat'][$bkey]['count'] = $bproduct['c'];
                }
            }
            
            
        }
       
        $array['sale'] = $products->getSaleCount();
        $array['bestseller'] = $products->getBestSellerCount();
        $array['new_products'] = $products->getNewProductsCount();
        $array['featured'] = $products->getFeaturedCount();
        return $array;
    }

    
}
