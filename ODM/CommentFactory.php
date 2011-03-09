<?php
    namespace MongoBlog\ODM;

    class CommentFactory extends DataFactory{
        public function creat($name,$params){
            $obj=new $name($params['author'],$params['datePub'],$params['text']);
            return $obj;
        }
    }
?>