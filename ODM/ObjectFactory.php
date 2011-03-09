<?php
    namespace MongoBlog\ODM;

    class ObjectFactory{
        
        public function create($name, $params) {
            $factory='MongoBlog\\ODM\\'.$name.'Factory';
            return  $factory::create($name,$params);
        }
        
    }
?>
