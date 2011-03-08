<?php
    namespace MongoBlog\ODM;

    class UserFactory extends DataFactory{
        public function createDataObject($params){
            $obj=new $this->dataObjectName;
            $obj->setLogin($collection['login']);
            $obj->setPassword($collection['pass']);
            $obj->setEmail($collection['email']);
            return $obj;
        }
    }
?>
