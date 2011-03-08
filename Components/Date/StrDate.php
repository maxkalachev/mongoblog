<?php
    namespace MongoBlog\Components\Date;

    class StrDate extends Date{
        private $strdate;

        public function __construct($strdate){
            $this->strdate=$strdate;
        }

        public function getDate(){
            return $this->strdate;
        }
    }
?>
