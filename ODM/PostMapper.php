<?php
    namespace MongoBlog\ODM;

    class PostMapper extends DataMapper{
        public function findPostsByAuthor($author){
            return $this->dm->find($this->collectionName,array('author'=>$author));
        }

        public function findPostsByDatePub($datePub){
            return $this->dm->find($this->collectionName,array('datePub'=>$this->dm->prepareDate($datePub)));
        }

        public function findPostsByTag($tag){
            return $this->dm->find($this->collectionName,array('tags'=>array('$all'=>array($tag))));
        }

        public function findCommentsForPost($post_id){
            $cursor=$this->dm->findOne($this->collectionName,array('_id'=>$this->dm->prepareId($post_id)));
            return $cursor['comments'];
        }
    }
?>
