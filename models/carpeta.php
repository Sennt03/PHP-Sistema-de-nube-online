<?php 
    class Carpeta{

        public function new($ruta){
            if(!is_dir("cloud/$ruta")){
                mkdir("cloud/$ruta");
            }
        }

        public function transformRuta($ruta){
            $search = '-';
            $replace = '/';
            $string = $ruta;
            $ruta = str_ireplace($search, $replace, $string);
            return $ruta;
        }

        public function getName($ruta){
            $inicio = strrpos($ruta, '-');
            $inicio++;
            $nombre = substr($ruta, $inicio);

            $final = strrpos($nombre, '.');
            $nombre = str_split($nombre, $final);
            $nombre = $nombre[0];
            
            return($nombre);
        }

        public function getExt($image){
            $inicio = strrpos($image, '/');
            $inicio++;
            $nombre = substr($image, $inicio);
            
            return($nombre);
        }

        public function getExtension($ruta){
            $inicio = strrpos($ruta, '-');
            $inicio++;
            $nombre = substr($ruta, $inicio);

            $extension = pathinfo($nombre, PATHINFO_EXTENSION);
            return $extension;
        }

        public function ver($id, $ruta){
            if(is_dir("cloud/$id/$ruta") || file_exists("cloud/$id/$ruta")){
                if($gestor = opendir("cloud/$id/$ruta")){
                    return $gestor;
                }
            }else{
                return false;
            }
        }

        public function vacio($id, $carpeta){
            $carpeta = @scandir("cloud/$id/$carpeta");
            if($carpeta != false){
                if(count($carpeta) > 2){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function isArchivo($archivo){
            $archivo = $archivo;

            if(strpos($archivo, '.') !== false) {
                return true;
            }else{
                return false;
            }
        }

        public function isImage($image){
            
            if(strrpos($image, '.jpg') !== false || strpos($image, '.jpeg') !== false || strpos($image, '.png') !== false || strpos($image, '.gif') !== false) {
                return true;
            }else{
                return false;
            }
        }

        public function isFile($id, $ruta){
            if(is_file("cloud/$id/$ruta")){
                return true;
            }else{
                return false;
            }
        }
    }
?>