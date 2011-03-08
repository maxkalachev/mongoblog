<?php
    namespace MongoBlog\Components\CryptoEngine;

    class CryptoMD5 implements CryptoEngine{
        public function encrypt($str){
            return \md5($str);
        }
    }
?>
