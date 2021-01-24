<?php

class Users extends Model
{

public function emailExists($email)
{
        $sql = "SELECT * FROM usuarios WHERE email = :email ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();
        if($sql->rowCount() > 0){
            return true;
        }else {
            return false;
        }
}
    public function getUsers($id)
    {
        $array = array();
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();


        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(\PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function edit($id, $nome, $email, $senha,$telefone,$cpf)
    {
        $sql = "UPDATE usuarios SET nome = :nome , email = :email  ,senha = :senha,telefone = :telefone,cpf = :cpf WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":telefone", $telefone);
        $sql->bindValue(":cpf", $cpf);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();
    }
    public function validate($email,$senha)
    {
        $uid = '';
        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $uid = $sql['id'];
        }
        return $uid; 

    }
    public function createUser($nome, $email, $senha)
    {

        $sql = "INSERT INTO usuarios(nome ,email, senha) VALUES (:nome,:email, :senha)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        return $this->db->lastInsertId();
    }





}