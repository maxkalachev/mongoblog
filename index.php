<?php
    namespace MongoBlog;

    use MongoBlog\ODM\ODMFactory;
    use MongoBlog\Components\CryptoEngine\CryptoMD5;
    use MongoBlog\Components\Date\StrDate;
    use MongoBlog\Components\Date\MongoDBDate;

    require_once __DIR__.'/autoload.php';
    $config=include 'config.php';

    $dm=ODM\DocumentManager::create();
    $dm->setConnection(new \Mongo("mongodb://{$config['dbhost']}"),array('dbname'=>$config['dbname']));

    //$userFactory=UserFactory::create($config['map']);
    //$postFactory=PostFactory::create($config['map']);
    //$commentFactory=CommentFactory::create();

    $dm->addMapper('User',ODMFactory::create('User','Mapper',array('collectionName'=>'users')));
    $dm->addMapper('Post',ODMFactory::create('Post','Mapper',array('collectionName'=>'posts')));

    $cryptoEngine=new CryptoMD5();
    
    $userMax=ODMFactory::create('User','Object',array('login'=>'max',
                                                       'pass'=>$cryptoEngine->encrypt('12345'),
                                                       'email'=>'mail@maxkalachev.ru'));

    $userJhon=ODMFactory::create('User','Object',array('login'=>'jhon',
                                                        'pass'=>$cryptoEngine->encrypt('abc'),
                                                        'email'=>'jhon@yandex.ru'));

    $comments=array(array('author'=>'max','datePub'=>'2011-03-09','text'=>'comment1'),
                    array('author'=>'max','datePub'=>'2011-03-10','text'=>'comment2'),
                    array('author'=>'jhon','datePub'=>'2011-03-10','text'=>'comment3'),);

    $post=ODMFactory::create('Post', 'Object', array('title'=>'post number one',
                                                     'author'=>'max',
                                                     'text'=>'a cool text',
                                                     'datePub'=>'2011-03-09',
                                                     'tags'=>array('nosql','mongodb'),
                                                     'comments'=>$comments));
    if ($dm->add('Post',$post)) echo 'done';
?>
