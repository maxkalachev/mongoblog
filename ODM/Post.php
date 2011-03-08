<?php
    namespace MongoBlog\ODM;

    class Post extends DataObject{
        private $title;
        private $text;
        private $author;

        /** @date **/
        private $datePub;

        private $tags=array();

        /** @referenceMany(target=Comment) **/
        private $comments=array();

        public function __construct($title,$text,$author,$datePub){
            $this->title=$title;
            $this->text=$text;
            $this->author=$author;
            $this->datePub=$datePub;
        }

        public function addTags($tags){
            $this->tags=\array_merge($this->tags,$tags);
        }

        public function addComment(Comment $comment){
           $this->comments[]=$comment;
        }
    }

?>
