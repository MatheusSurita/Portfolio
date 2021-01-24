<?php 
class Contato extends Model
{


public function sendMail()
{
        
        $email = addslashes($_POST['email']);
        $nome = addslashes($_POST['nome']);
        $msg = addslashes($_POST['mensagem']);
       
        
        $to = 'matheus.surita@gmail.com';
        $subject = "Contato - Torre dos games";
        $body = "Nome: ".$nome."\r\n"
                ."Email: ".$email. "\r\n"
                ."Mensagem: ".$msg;
        

        $header = "From:netzueira571@gmail.com"."\r\n"
        ."reply-to: ".$email."\r\n"
        ."X-mailer: PHP/" .phpversion();


        mail($to,
            $subject,
            $body,
            $header
        );

       if(!empty(mail($to,$subject,$body,$header)))
       {echo " O Email foi enviado";
            
       }else {
          echo "email nao foi enviado";
           
       }
      
        exit;



}
    public function mail()
    {
        # code...
    }
}
