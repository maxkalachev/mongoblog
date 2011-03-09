<?php
    namespace MongoBlog\ODM;

    class ObjectFactory{
        
        public function create($name, $params) {
            $factoryName='MongoBlog\\ODM\\'.$name.'Factory';
            $factory=new $factoryName();
            return  $factory->create($name,$params);
        }
        
    }
?>
