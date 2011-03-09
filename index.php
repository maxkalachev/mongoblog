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

    var_dump($userMax);
    var_dump($userJhon);

    /*
    $user=new User();
    
    $user->setLogin('max');
    $user->setPassword('12345',new CryptoMD5());
    $user->setEmail('email@gmail.com');

    $dm->addMapper('User',new UserMapper('users'));
    $dm->addMapper('Post',new PostMapper('posts'));
    $dm->addMapper('Comment',new CommentMapper('comments'));

    //if ($dm->add('User',$user)) echo 'done';
    //if ($dm->auth('User','max','12345')) echo 'authorization success';
    //else echo 'authorization filed';

    //$post=new Post('A witty title','','max','2011-03-03');
    //$post->addTags(array('nosql','key-value storage','map/reduce'));

    //$post->addComment(new Comment('max',$dt->getDate(),'This is a first comment'));
    //$post->addComment(new Comment('max',$dt->getDate(),'This is a second comment'));
    //if ($dm->add('Post',$post)) echo 'done';

    //$dm->ensureIndex('Post',array('tags'=>1,'datePub'=>1));
    //$post_id=$dm->findValue('Post',array('title'=>'A witty title'),array('_id'));

    $post=new Post('A witty title','text','max','2011-03-07');
    $post->addTags(array('studying','map/reduce'));

    $post->addComment(new Comment('max','2011-03-06','This is a first comment'));
    $post->addComment(new Comment('max','2011-03-07','This is a second comment'));

    if ($dm->add('Post',$post)) echo 'done';

    
    //if ($dm->updateData('Post',$post_id,$post)) echo 'done';
    /*
    $comments=$dm->findCommentsForPost('Post',$post_id);

    foreach ($comments as $comment){
        echo $comment['text'].'<br>';
    }
    
    
    $dt=new MongoDBDate(new StrDate('2011-03-03'));
    $posts=$dm->findPostsByDatePub('Post','2011-03-03');

    foreach ($posts as $post){
        echo $post['title'].'<br>';
    }
*/
?>
