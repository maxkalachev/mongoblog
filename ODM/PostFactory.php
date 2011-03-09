<?php
    namespace MongoBlog\ODM;

    class PostFactory extends DataFactory{
        public function create($name,$params){
            $obj=new $name($params['title'],$params['text'],$params['author'],$params['datePub']);
            $obj->addTags($params['tags']);
            
            foreach ($params['comments'] as $comment){
                $commentObj=CommentFactory::create('Comment',array($comment['author'],$comment['datePub'],$comment['text']));
                $obj->addComment($commentObj);
            }

            return $obj;
        }
    }
?>
