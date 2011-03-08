<?php
    namespace MongoBlog\Components\Date;

    class MongoDBDate extends DateDecorator{
        public function getDate(){
            return new \MongoDate(strtotime($this->date->getDate()));
        }

        public function getSec(){
            $dt=new \MongoDate(strtotime($this->date->getDate()));
            return $dt->sec;
        }
    }
?>
