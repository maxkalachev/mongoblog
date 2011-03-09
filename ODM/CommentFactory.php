<?php
    namespace MongoBlog\ODM;

    class CommentFactory implements DataFactory{
        public function create($name,$params){
            $clsName='MongoBlog\\ODM\\'.$name;
            $obj=new $clsName($params['author'],$params['datePub'],$params['text']);
            return $obj;
        }
    }
?>