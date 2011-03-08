<?php
    namespace MongoBlog\ODM;

    class PostFactory extends DataFactory{
        public function createDataObject($params){
            $obj=new $this->dataObjectName($params['title'],$params['text'],$parans['author'],$params['datePub']);
            $obj->addTags($params['tags']);

            foreach ($params['comments'] as $comment){
                
                $obj->addComment($commentObj);
            }

            return $obj;
        }
    }
?>
