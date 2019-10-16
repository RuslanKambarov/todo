<?php
namespace todo;
require 'config/config.php';

use router\Router;

spl_autoload_register(function ($class) {
    
    include str_replace("\\", "/", $class. '.php');

});


$router = new Router();
$router->parse();

?>