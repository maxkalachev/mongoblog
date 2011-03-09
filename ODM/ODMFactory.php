<?php
    namespace MongoBlog\ODM;

    class ODMFactory{
        private function __construct(){}
        private function __clone(){}

        public static function create($objName,$service,$params){
            switch($service){
                case 'Object':
                    return ObjectFactory::create($objName,$params);

                case 'Mapper':
                    return MapperFactory::create($objName,$params);
            }
        }
    }
?>
