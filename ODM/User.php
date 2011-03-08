<?php
    namespace MongoBlog\ODM;
    use MongoBlog\Components\CryptoEngine\CryptoEngine;

    class User extends DataObject{
        private $login;
        private $pass;
        private $email;

        public function __construct(){
            
        }

        public function setLogin($login){
            $this->login=$login;
        }

        public function getLogin(){
            return $this->login;
        }

        public function setPassword($pass, CryptoEngine $cryptoEngine){
            $this->pass=$cryptoEngine->encrypt($pass);
        }

        public function getPassword(){
            return $this->pass;
        }

        public function setEmail($email){
            $this->email=$email;
        }

        public function getEmail(){
            return $this->email;
        }
    }
?>