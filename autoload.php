<?php 
    function controllers_autoloader($class){
        include 'controllers/'.$class.'.php';
    }

    spl_autoload_register('controllers_autoloader');
?>