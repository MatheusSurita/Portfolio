<?php
require 'environment.php';
global $db;
global $config;
$config = array();

date_default_timezone_set('America/Sao_Paulo');
if (ENVIRONMENT == 'development') {
    define("TITLE","Torre dos Games");
    define("BASE_URL", "http://localhost/loja/");
   $config['dbname'] = 'loja';
   $config['host'] = 'localhost';
   $config['dbuser'] = 'root';
   $config['dbpass'] = '';
}else{
    define("BASE_URL", "http://localhost/loja/");
    $config['dbname'] = 'loja';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}
$config['cep'] = '03620000';
$config['pagseguro_seller'] = 'matheus.surita@gmail.com';
$config['mp_appid'] = '5814587937993965';
$config['mp_key'] = 'J7acsB9lTRjPJjgQLa3waVjKB29rF3k3';

   $db = new PDO ("mysql:dbname=".$config['dbname'].";host=".$config['host'],$config['dbuser'],$config['dbpass']); 
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

\PagSeguro\Library::initialize();
\PagSeguro\Library::cmsVersion()->setName('Big Tower Games')->setRelease("1.0.0");
\PagSeguro\Library::moduleVersion()->setName('Big Tower Games')->setRelease("1.0.0");

\PagSeguro\Configuration\Configure::setEnvironment('sandbox');
\PagSeguro\Configuration\Configure::setAccountCredentials('matheus.surita@gmail.com', '9CBEC0E27F11419A86AA11AAF5D77A48');
\PagSeguro\Configuration\Configure::setCharset('UTF-8');
\PagSeguro\Configuration\Configure::setLog(true , 'pagseguro.log');

?>