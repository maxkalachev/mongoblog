<?php
    namespace MongoBlog\ODM;
    use MongoBlog\Components\CryptoEngine\CryptoMD5;

    class UserMapper extends DataMapper{
        public function findByLogin($login){
            return $this->dm->findOne($this->collectionName,array('login' => $login));
        }

        // TODO phpDoc here
        public function auth($login,$password){
            $user=$this->findByLogin($login);
            $encryptEngine=new CryptoMD5();
            $pass=$encryptEngine->encrypt($password);
            return ($pass==$user['pass']);
        }
    }

?>
