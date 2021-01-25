<?php 
    require_once 'models/user.php';
    require_once 'models/carpeta.php';
    class userController{

        public function login(){
            Utils::notLogged();
            require_once 'views/user/login.php';
        }

        public function register(){
            Utils::notLogged();
            require_once 'views/user/register.php';
        }

        public function save(){
           
            if(isset($_POST)){
                $user = new User();
                $name = isset($_POST['name']) ? $_POST['name'] : false;
                $email = isset($_POST['email']) ? $_POST['email'] : false;
                $password = isset($_POST['password']) ? $_POST['password'] : false;
            }

            if($name && $email && $password){
                $user->setName($name);
                $user->setEmail($email);
                $user->setPassword($password);
                $save = $user->save();
                if(!$save){
                    $_SESSION['err'] = 'El correo ya esta registrado';
                    header('Location: '.base_url.'user/register/');
                }else{
                    $user = $user->login($password);
                    $_SESSION['user'] = $user;
                    $carpeta = new Carpeta();
                    $carpeta->new($user->id);
                }
                
            }else{
                $_SESSION['err'] = 'Rellene todos los campos porfavor';
                header('Location: '.base_url.'user/register/');
            }

            if(!isset($_SESSION['err'])){
                header('Location: '.base_url.'user/carpetas/');
            }
            
        }

        public function log(){
            if(isset($_POST)){
                $user = new User();
                $email = isset($_POST['email']) ? $_POST['email'] : false;
                $password = isset($_POST['password']) ? $_POST['password'] : false;
            }
            if($email && $password){
                $user->setEmail($email);
                
                $save = $user->login($password);
                if($save != 'email' && $save != 'password'){
                    $_SESSION['user'] = $save;
                    header('Location: '.base_url.'user/carpetas/');
                }else if($save == 'email'){
                    $_SESSION['err'] = 'El correo no existe';
                    header('Location: '.base_url);
                }else if($save == 'password'){
                    $_SESSION['err'] = 'La contrseña es incorrecta';
                    header('Location: '.base_url);
                }
            }else{
                $_SESSION['err'] = 'Rellene todos los campos porfavor';
                header('Location: '.base_url.'user/login/');
            }

        }

        public function logout(){
            unset($_SESSION['user']);
            header('Location: '.base_url);
        }

        public function carpetas(){
            Utils::isLogged();
            $id = $_SESSION['user']->id;
            $carpeta = new Carpeta();

            $ruta = $_GET['ruta'];
            if($ruta != ''){
                $ruta = $carpeta->transformRuta($ruta);
            }
            if(!is_dir($ruta)){
                header('Location: '.base_url);
            }

            $vacio = $carpeta->vacio($id, $ruta);
            $gestor = $carpeta->ver($id, $ruta);
            $no_ver = false;
            if($gestor == false){
                $no_ver = true;
            }
            
            require_once 'views/user/carpetas.php';
        }

        public function archivos(){
            Utils::isLogged();

            $id = $_SESSION['user']->id;
            $carpeta = new Carpeta();

            $rutaOriginal = $_GET['ruta'];
            if($rutaOriginal != ''){
                $ruta = $carpeta->transformRuta($rutaOriginal);
            }

            $isFile = $carpeta->isFile($id, $ruta);
            if($isFile == false){
                header('Location: '.base_url.'user/carpetas/'.$rutaOriginal);
            }else{
                header('Location: '.base_url."directorio/detalles/$rutaOriginal");
            }
            
        }
    }
?>