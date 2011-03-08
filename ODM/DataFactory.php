<?php
    namespace MongoBlog\ODM;

    abstract class DataFactory{
        private static $instance;

        protected $map;
        protected $dataObjectName;

        private function __construct(){}
        private function __clone(){}

        public static function create($map){
            if (!isset(self::$instance)){
                self::$instance=new self;
            }
            return self::$instance;
        }

        public function init($map){
            $this->map=$map;

            \preg_match('/(.+)Factory/',__CLASS__,$matches);
            $this->dataObjectName=$matches[1];
        }

        public function createDataObject($params){}
        
        public function createDataMapper($collectionName){
            $className=$this->map[$collectionName].'Mapper';
            return new $className($collectionName);
        }
    }
?>
