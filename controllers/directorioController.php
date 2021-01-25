<?php
    require_once 'models/carpeta.php';
    class directorioController{
        public function detalles(){
            Utils::isLogged();
            if($_GET['ruta'] != ''){
                $id = $_SESSION['user']->id;
                $carpeta = new Carpeta(); 
                $rutaOriginal = $_GET['ruta'];
                $ruta = $carpeta->transformRuta($rutaOriginal);
                if($carpeta->isFile($id, $ruta)){
                    $archivo = $carpeta->transformRuta($rutaOriginal);
                    $nombre = $carpeta->getName($rutaOriginal);
                    $extension = $carpeta->getExtension($rutaOriginal);
                    $_SESSION['archivo'] = array(
                        "size" => Utils::transformKb(filesize("cloud/$id/$archivo")),
                        "extension" => $extension,
                        "ruta" => "cloud/$id/$archivo",
                        "nombre" => $nombre
                    );
                    
                    if($_SESSION['archivo']['size'] > 999){
                        $_SESSION['archivo']['size'] = Utils::transformMb($_SESSION['archivo']['size']);
                        $_SESSION['mb'] = 'true';
                    }
                    $inicio = strrpos($rutaOriginal, '-');
                    if($inicio != false){
                        $ruta = str_split($rutaOriginal, $inicio);
                        $ruta = $ruta[0];
                    }else{
                        $ruta = '';
                    }
                    
                    
                    header('Location: '.base_url."user/carpetas/$ruta");
                }
                
            }else{
                header('Location: '.base_url.'user/carpetas/');
            }
        }

        public function anterior(){
            Utils::isLogged();
            if($_GET['ruta'] != ''){
                $ruta = $_GET['ruta'];
                $cortar = strrpos($ruta, '-');
                if($cortar == false){
                    header('Location: '.base_url."user/carpetas/");
                }else{
                    $cortado = str_split($ruta, $cortar);
                    $ruta = $cortado[0];
                    header('Location: '.base_url."user/carpetas/$ruta");
                }  
            }else{
                header('Location: '.base_url."user/carpetas/");
            }
        }

        public function crear(){
            Utils::isLogged();
            $rutaOriginal = $_GET['ruta'];
            if(isset($_POST)){
                $name = isset($_POST['name']) ? $_POST['name'] : false;
                $verify = strrpos($name, '.');
                
                if($verify == false){
                    if($name != ''){
                        $carpeta = new Carpeta();
                        $id = $_SESSION['user']->id;
                            if($_GET['ruta'] != ''){
                               $ruta = $carpeta->transformRuta($_GET['ruta']);
                        }else{
                             $ruta = '';
                        }

                        if(!is_dir("cloud/$id/$ruta")){
                            $_SESSION['aqui'] = 'Elige una carpeta donde crearla';
                            header('Location: '.base_url."user/carpetas/");
                        }
                        
                        if(!is_dir("cloud/$id/$ruta/$name")){
                            mkdir("cloud/$id/$ruta/$name");
                            $_SESSION['ok'] = 'Carpeta creada correctamente';
                            header('Location: '.base_url."user/carpetas/$rutaOriginal");
                        }else{
                            $_SESSION['err'] = 'La carpeta ya existe';
                        }
                    }else{
                        $_SESSION['err'] = 'Introdusca un nombre';
                    }
                }else{
                    $_SESSION['err'] = 'El nombre no puede incluir puntos';
                }

            }else{
                $_SESSION['err'] = 'Introdusca un nombre';
            }

           header('Location: '.base_url."user/carpetas/$rutaOriginal");
        }

        public function subir(){
            Utils::isLogged();
                
                $archivo = $_FILES['archivo'];
                $ruta = $_GET['ruta'];
                if($ruta != ''){
                    $carpeta = new Carpeta();
                    $ruta = $carpeta->transformRuta($ruta);
                }
                
            if($archivo['name'] != ''){
                $name = $archivo['name'];
                $tmp_name = $archivo['tmp_name'];
                $id = $_SESSION['user']->id;
                if(!is_dir("cloud/$id/$ruta")){
                    $_SESSION['aquiA'] = 'Elije una carpeta para subir el archivo';
                    
                    header('Location: '.base_url.'user/carpetas/');
                }
                header('Location: '.base_url."user/carpetas/".$_GET['ruta']);
                move_uploaded_file($tmp_name, "cloud/$id/$ruta/$name");
                $_SESSION['oka'] = 'Archivo subido correctamente';
            }else{
                $_SESSION['erra'] = 'Suba algun archivo porfavor';
                header('Location: '.base_url."user/carpetas/".$_GET['ruta']);
            }
        }

        public function image(){
            Utils::isLogged();
            
            $ruta = $_GET['ruta'];
            $id = $_SESSION['user']->id;
            $carpeta = new Carpeta();
            $inicio = strrpos($_GET['ruta'], '-');
            if($inicio != false){
                $nombre = $carpeta->getName($ruta);
                $ruta = $carpeta->transformRuta($ruta);
            }else{
                $ruta = $_GET['ruta'];
                $inicio = strrpos($ruta, '.');
                if($inicio != false){
                    $nombre = str_split($ruta, $inicio);
                    $nombre = $nombre[0];
                }else{
                    header('Location: '.base_url);
                }
            }

            if($ruta != ''){
                if($carpeta->isFile($id, $ruta)){
                    $image = base_url."cloud/$id/$ruta";
                    $img = exif_read_data($image);
                    
                    $tamaño = Utils::transformKb($img['FileSize']);
                    $mb = false;
                    if($tamaño > 999){
                        $tamaño = Utils::transformMb($tamaño);
                        $mb = true;
                    }
                    $extension = $carpeta->getExt($img['MimeType']);
                    
                    require_once 'views/user/images.php';
                }else{
                    header('Location: '.base_url);
                }
            }else{
                header('Location: '.base_url);
            }

        }

        public function config(){
            Utils::isLogged();

            if($_GET['ruta'] != ''){
                $ruta = $_GET['ruta'];
                $id = $_SESSION['user']->id;
                $nombre = $ruta;
                $inicio = strrpos($ruta, '-');
                $carpeta = new Carpeta();
                if($inicio != false){
                    $ruta = $carpeta->transformRuta($ruta);
                    $inicio++;
                    $nombre = substr($ruta, $inicio);
                }
                
                if(file_exists("cloud/$id/$ruta") == false){
                    header('Location: '.base_url);
                }
                
                require_once 'views/user/config.php';
            }else{
                header('Location: '.base_url);
            }
        }
    }
?>