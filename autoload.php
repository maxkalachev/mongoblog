<?php
    $autoload=function($class){
        $path=explode('\\',$class);

        if (array_shift($path)!='MongoBlog')
            throw new \MongoBlog\Exceptions\WrongNamespace();

        $filename=array_pop($path);

        require_once __DIR__.'/'.implode('/',$path).'/'.$filename.'.php';
    };

    spl_autoload_register($autoload);
?>
