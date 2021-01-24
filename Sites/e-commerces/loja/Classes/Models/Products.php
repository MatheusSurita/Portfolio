<?php

class Products extends Model{
    public function getInfo($id)
    {
        $array= array();
    $sql = "SELECT * FROM products where id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(":id" , $id);
    $sql->execute();
    if($sql->rowCount() > 0){
        $array = $sql->fetch();
        $images =current($this->getImagesByProductsId($id));
        $array['image'] = $images['url'];
    }
        return $array;
    }


public function getSaleCount($filters = [])
{
     $where = $this->buildWhere($filters);
        $sql = "SELECT COUNT(*) as c from products WHERE " .implode(' AND ', $where);
        $sql = $this->db->prepare($sql);
        $this->bindWhere($filters , $sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            return $sql['c'];
        }else {
            return '0';
        }
}
    public function getBestSellerCount($filters = [])
    {
        $where = $this->buildWhere($filters);
        $sql = "SELECT COUNT(*) as c from products WHERE " .implode(' AND ', $where);
        $sql = $this->db->prepare($sql);
        $this->bindWhere($filters, $sql);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            return $sql['c'];
        } else {
            return '0';
        }
    }
    public function getNewProductsCount($filters = [])
    {
        $where = $this->buildWhere($filters);
        $sql = "SELECT COUNT(*) as c from products WHERE " .implode(' AND ', $where);
        $sql = $this->db->prepare($sql);
        $this->bindWhere($filters, $sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            return $sql['c'];
        } else {
            return '0';
        }
    }

    public function getProductInfo($id)
    {
        $array = array();
        if (!empty($id)) {
            $sql = "SELECT *, (select brends.name from brends where brends.id = products.id_brend) 
        as brends_name FROM products WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }
            
        }
        return $array;
    }

    public function getFeaturedCount($filters = [])
    {
        $where = $this->buildWhere($filters);
        $sql = "SELECT COUNT(*) as c from products WHERE " .implode(' AND ', $where);
        $sql = $this->db->prepare($sql);
        $this->bindWhere($filters, $sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            return $sql['c'];
        } else {
            return '0';
        }
    }
    public function getListOfGamecat()
    {
        $array = array();
        $where = [
            '1=1'
        ];

        if (!empty($filters['gamecat'])) {
            $where[] = "id_gamecat IN ('" . implode("','", $filters['gamecat']) . "')";
        }

        $sql = "SELECT id_gamecat ,COUNT(id) as c from products WHERE " .implode(' AND ', $where) . " GROUP BY id_category";
        $sql = $this->db->prepare($sql);

        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
            
        }
        return $array;
    }

    public function getList($offset,$limit,$filters = [], $random = false){
        $array = array();

        $orderBySQL = '';
        if($random == true){
            $orderBySQL = "ORDER BY RAND()";
        }
        $where = $this->buildWhere($filters);


        $sql = "SELECT *,(select brends.name from brends where brends.id = products.id_brend) 
        as brends_name,(select categories.name from categories where categories.id = products.id_category) 
        as category_name,(select gamecat.name from gamecat where gamecat.id = products.id_gamecat) 
        as gamecat_name FROM products WHERE ".implode(' AND ' , $where)."".$orderBySQL." LIMIT $offset , $limit";
        $sql = $this->db->prepare($sql);

        $this->bindWhere($filters , $sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
         $array = $sql->fetchAll();

         foreach ($array as $key => $item) {
            $array[$key]['images'] = $this-> getImagesByProductsId($item['id']);
         }

        }
        return $array;
    }
    

public function getImagesByProductsId($id){
    $array = array();
$sql = "SELECT url FROM products_images WHERE id_products = :id ";
$sql = $this->db->prepare($sql);
$sql->bindValue(":id" , $id);
$sql->execute();

if ($sql->rowCount() > 0) {
    $array = $sql->fetchAll();
}
return $array;

}

 public function getTotal($filters = array()){

    $where = $this->buildWhere($filters);

        $sql = "SELECT COUNT(*) as c FROM products  WHERE ".implode(' AND ', $where);
        $sql = $this->db->prepare($sql);
        $this->bindWhere($filters, $sql);

        $sql->execute();
        $sql = $sql->fetch();
        return $sql['c'];
    }

    private  function buildWhere($filters)
    {
        $where = [
            '1=1'
        ];

        if(!empty($filters['category'])) {
         $where[] = "id_category = :id_category";
        }
        if (!empty($filters['gamecat'])) {
            $where[] = "id_gamecat IN ('".implode("','",$filters['gamecat'])."')";
        }
        if (!empty($filters['sale'])) {
            $where[] = "sale = '1'";
        }
        if (!empty($filters['bestseller'])) {
            $where[] = "bestseller = '1'";
        }
        if (!empty($filters['new_products'])) {
            $where[] = "new_products = '1'";
        }
        if (!empty($filters['featured'])) {
            $where[] = "featured = '1'";
        }
        if (!empty($filters['searchTerm'])) {
            $where[] = "name LIKE :searchTerm";
        }
        return $where;
    }
    private function bindWhere($filters,&$sql)
    {
       

        if (!empty($filters['searchTerm'])) {
            $sql->bindValue (":searchTerm", '%'.$filters['searchTerm'].'%');
        }

        if (!empty($filters['category'])) {
            $sql->bindValue(":id_category", $filters['category']);
        }
    }





}