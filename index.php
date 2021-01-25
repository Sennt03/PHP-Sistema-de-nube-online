<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'autoload.php';
    require_once 'config/db.php';
    require_once 'config/parametros.php';
    require_once 'helpers/utilidades.php';

    if(isset($_GET['controller'])){
        $name_controller = $_GET['controller'].'Controller';
    }else if(!isset($_GET['controller']) && !isset($_GET['action'])){
        $name_controller = controller_default;
    }else{
        echo 'La pagina no existe';
        exit();
    }
    if(isset($_SESSION['user'])) {
        require_once 'views/layout/header.php';
        require_once 'views/layout/centro.php';
    }

    if(class_exists($name_controller)){
        $controlador = new $name_controller();

        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action = $_GET['action'];
            $controlador->$action();
        }else if(!isset($_GET['controller']) && !isset($_GET['action'])){
            $action = action_default;
            $controlador->$action();
        }else{
            echo 'La pagina no existe';
        }
    }else{
        echo 'La pagina no existe';
    }

    if(isset($_SESSION['user'])){
        require_once 'views/layout/footer.php';
    }
    
?>