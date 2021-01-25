<?php 
    class Utils{
        public static function isLogged(){
            if(!isset($_SESSION['user'])){
                header('Location: '.base_url);
            }
        }

        public static function notLogged(){
            if(isset($_SESSION['user'])){
                header('Location: '.base_url.'user/carpetas/');
            }
        }

        public static function deleteSession($session){
            if(isset($_SESSION[$session])){
                unset($_SESSION[$session]);
            }
        }

        public static function transformKb($kb){
                $mb = $kb/1000;
                $mb = round($mb);
                return $mb;
        }

        public static function transformMb($kb){
            $mb = $kb/1000;
            $mb = round($mb, 2);
            return $mb;
        }
    }
?>