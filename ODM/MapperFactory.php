<?php
    namespace MongoBlog\ODM;

    class MapperFactory{

        public static function create($name,$params){
            $clsName='MongoBlog\\ODM\\'.$name.'Mapper';
            $obj=new $clsName($params['collectionName']);
            return $obj;
        }

    }
?>
