<?php 
    class User{
        private $id;
        private $name;
        private $email;
        private $password;
        private $rol;
        private $db;

        public function __construct(){
            $this->db = Database::connect();
        }

        public function save(){
           $sql = "INSERT INTO usuarios VALUES(null, '{$this->getName()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user')";
            $save = $this->db->query($sql);
            
            $result = false;
            if($save){
                $result = true;
            }

            return $result;
        }

        public function login($password){
            $sql = "SELECT * FROM usuarios WHERE email='{$this->getEmail()}'";
            $login = $this->db->query($sql);

            $result = false;
            
            if($login->num_rows > 0){
                $user = $login->fetch_object();
                if(password_verify($password, $user->password)){
                    $result = $user;
                }else{
                    $result = 'password';
                }
            }else{
                $result = 'email';
            }
            return $result;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $this->db->real_escape_string($name);
        }

        public function getEmail(){
            return $this->db->real_escape_string($this->email);
        }

        public function setEmail($email){
                $this->email = $email;
        }

        public function getPassword(){
            return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 10]);
        }

        public function setPassword($password){
                $this->password = $password;
        }

        public function getRol(){
            return $this->rol;
        }

        public function setRol($rol){
            $this->rol = $rol;
        }

    }
?>