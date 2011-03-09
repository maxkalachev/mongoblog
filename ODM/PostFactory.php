<?php
    namespace MongoBlog\ODM;

    class PostFactory implements DataFactory{
        public function create($name,$params){
            $clsName='MongoBlog\\ODM\\'.$name;
            $obj=new $clsName($params['title'],$params['text'],$params['author'],$params['datePub']);
            
            $obj->addTags($params['tags']);

            foreach ($params['comments'] as $comment){
                $commentFactory=new CommentFactory();
                $commentObj=$commentFactory->create('Comment',array('author'=>$comment['author'],
                                                                    'datePub'=>$comment['datePub'],
                                                                    'text'=>$comment['text']));
                $obj->addComment($commentObj);
            }

            return $obj;
        }
    }
?>
