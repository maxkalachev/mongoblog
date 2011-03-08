<?php
    namespace MongoBlog\Components\Date;

    abstract class DateDecorator extends Date{
        protected $date;
        
        public function __construct(Date $date){
            $this->date=$date;
        }
    }
?>
