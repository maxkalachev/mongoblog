<?php
    namespace MongoBlog\ODM;

    class Comment extends DataObject{
        private $author;

        /** @date **/
        private $datePub;
        
        private $text;

        public function __construct($author,$datePub,$text){
            $this->author=$author;
            $this->datePub=$datePub;
            $this->text=$text;
        }

        public function getAuthor(){
            return $this->author;
        }

        public function getDatePub(){
            return $this->datePub;
        }

        public function setDatePub($date){
            $this->datePub=$date;
        }

        public function getText(){
            return $this->text;
        }
    }

?>
