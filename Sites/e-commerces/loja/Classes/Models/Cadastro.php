<?php

class Cadastro extends Model{
     
    public function VerificarLogin(){
        if (!isset($_SESSION['TOWER'])|| (isset($_SESSION['TOWER']) && empty($_SESSION['TOWER']))) {
            return false;
        }
        }
     

    public function Cadastrar()
    {
        if (!empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $CPF = addslashes($_POST['cpf']);
            $telefone = addslashes($_POST['telefone']);
            $senha = addslashes(sha1($_POST['senha']));
            /*verificar se email ta cadastrado */
            $sql = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email ");
            $sql->bindValue(":email", $email);
            $sql->execute();

            /*cadastro de login*/
            if ($sql->rowCount() == 0) {
                $sql = $this->db->prepare("INSERT INTO usuarios  (nome,email,senha,cpf,telefone) VALUES (:nome,:email ,:senha ,:cpf, :telefone)");
                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":email", $email);
                $sql->bindValue(":cpf", $CPF);
                $sql->bindValue(":telefone", $telefone);
                $sql->bindValue(":senha", $senha);
                $sql->execute();
                $id = $this->db->lastInsertid();
                $_SESSION['TOWER'] = $id;
                header("location: ".BASE_URL);
                exit;
                /*Cadastro confirmaçao no E-mail e so excluir o de cima e rodar e colocar proteçao contra sql inject
                $this->db->query("INSERT INTO usuarios SET nome = '$nome' , email = '$email' , senha = '$senha'");
                $id = $this->db->lastInsertId();

                $sha1 = sha1($id);
                $link = "http://www.mdgamesbrasil.com/cadastro/confirmar.php?h=" . $sha1;

                $assunto = "confirme seu cadastro";
                $msg = " clique abaixo para corfirmar seu cadastro:\n\n" . $link;
                $headers = "From: Suporte@mdgamesbrasil.com.br" . "\r\n" .
                    "X-mailer: PHP/" . phpversion();

                mail($email, $assunto, $msg, $headers);
                echo "<h2>ok! Confirme seu cadastro agora !</h2>";

                exit;*/
            } else {
               
               return "Esse E-mail ja foi usado";
               
            }
        }

    }

    public function Login()
    {
    
        if(isset($_POST['email'])&& !empty($_POST['email'])){
            $email = addslashes($_POST['email']);
            $senha = addslashes(sha1($_POST['senha']));
         
            $sql = "SELECT * FROM  usuarios where email = :email  AND senha = :senha";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":email",$email);
            $sql->bindValue(":senha", $senha);
            $sql->execute();
            if($sql->rowCount() > 0) {
                $sql = $sql->fetch();
                $_SESSION['TOWER'] = $sql['id'];
                
                header("location: ".BASE_URL);
                exit;
            } else {
                return "Não foi possível entrar pois o email ou senha não conferem. Por favor tente novamente com outro email ou senha";
            }
        }
    
    }

    public function Esqueci(){
        if (!empty($_POST['email'])) {
            $email = addslashes($_POST['email']);
            

            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $sql = $this->db->prepare($sql);
            $sql->bindvalue("email", $email);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $sql = $sql->fetch();
                $id = $sql['id'];

                $token = md5(time() . rand(0, 99999) . rand(0, 99999));
                $sql = "INSERT INTO usuarios_token (id_usuario, hash, expirado) VALUES (:id_usuario, :hash, :expirado)";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id_usuario", $id);
                $sql->bindValue(":hash", $token);
                $sql->bindValue(":expirado", date('y-m-d h:i', strtotime('+1 day')));
                $sql->execute();

                $link = "http://localhost/loja/login/redefinir?token=".$token;
                $msg = "Acesse Seu email e clique para redefinir sua senha ".$link;
                $assunto = "redefinir senha";
                $headers = 'From: suporte@mdgames.com.br' . "\r\n" .
                'X-mailer: PHP/' . phpversion();
                //mail($email, $assunto, $msg ,$headers);
                echo $msg;
                exit;
            }
        }
    }
 
    public function getUser($id)
    { 
        $array  = array();
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id ");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function Redefinir(){
        if (!empty($_GET['token'])) {
            $token = $_GET['token'];
            $sql = "SELECT * FROM usuarios_token WHERE hash = :hash AND used = 0 AND expirado > NOW()";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":hash", $token);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $sql = $sql->fetch();
                $id = $sql['id_usuario'];


                if (!empty($_POST['senha'])) {
                    $senha = addslashes($_POST['senha']);
                    $sql = "UPDATE usuarios SET senha = :senha WHERE id = :id";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":senha", sha1($senha));
                    $sql->bindValue(":id", $id);
                    $sql->execute();

                    $sql = "UPDATE usuarios_token SET used = 1 WHERE hash = :hash";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":hash", $token);
                    $sql->execute();
                    header('location: http://localhost/loja/');
                    exit;
                }
            } else {
                echo "Token invalido ou usado!";
                exit;
            }
        }
    }
}

