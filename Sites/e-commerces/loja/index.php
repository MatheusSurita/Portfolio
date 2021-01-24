<?php 
session_start();
require 'vendor/autoload.php';
require 'config.php';



spl_autoload_register(function($class){

   if (file_exists('Classes/Controllers/'.$class.'.php')) {
       require_once 'Classes/Controllers/'.$class.'.php';
   }
    else if (file_exists('Classes/Models/'.$class.'.php')) {
        require_once 'Classes/Models/'.$class.'.php';

    } else if (file_exists('Classes/Core/'.$class.'.php')) {
        require_once 'Classes/Core/'.$class.'.php';
    }

});

$core = new Core();
$core->run();

?>
