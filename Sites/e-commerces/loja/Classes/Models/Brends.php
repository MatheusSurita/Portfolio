<?php

class Brends extends Model{


public function getList()
{
   $array = array();
   $sql= "SELECT * FROM brends";
   $sql = $this->db->query($sql);
   if($sql->rowCount() > 0 ){
$array = $sql->fetchAll();
   }
return $array;
}

public function getNamebyId($id){
$sql = "SELECT name from brends WHERE id = :id";
$sql = $this->db->prepare($sql);
$sql->bindValue(":id" , $id);
$sql->execute();
if ($sql->rowCount() > 0) {
$data = $sql->fetch();
return $data['name'];
}else{
    return '';
    }
  }
}