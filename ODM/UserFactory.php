<?php
    namespace MongoBlog\ODM;

    class UserFactory implements DataFactory{
        public function create($name,$params){
            $clsName='MongoBlog\\ODM\\'.$name;
            $obj=new $clsName;
            $obj->setLogin($params['login']);
            $obj->setPassword($params['pass']);
            $obj->setEmail($params['email']);
            return $obj;
        }
    }
?>
