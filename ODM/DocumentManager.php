<?php
    namespace MongoBlog\ODM;

    use MongoBlog\Components\Date\StrDate;
    use MongoBlog\Components\Date\MongoDBDate;
    
    class DocumentManager{
        private static $instance;

        private $conn;
        private $params;
        private $db;

        private $mappers=Array();

        private function __construct(){}
        private function __clone(){}

        public static function create(){
            if (!isset(self::$instance)){
                self::$instance=new self;
            }
            return self::$instance;
        }

        public function __call($name,$arguments){
            $mapper=$this->mappers[$arguments[0]];
            $method=new \ReflectionMethod($mapper, $name);
            array_shift($arguments);
            return $method->invokeArgs($mapper, $arguments);
        }

        public function setConnection($conn,$params){
            $this->conn=$conn;
            $this->params=$params;

            $this->db=$conn->selectDB($params['dbname']);
            return true;
        }

        public function addMapper($mapperName, DataMapper $mapper){
            $this->mappers[$mapperName]=$mapper;
            $this->mappers[$mapperName]->setDM($this);
        }

        public function getMapper($mapperName){
            return $this->mappers[$mapperName];
        }
        
        // make an Array object $document from php object $obj
        public function buildDocumentFromObject(DataObject $obj){
          echo 'obj<br>';
          $reflect= new \ReflectionObject($obj);
          $props=$reflect->getProperties(\ReflectionProperty::IS_PRIVATE);

          $document=Array();
          foreach($props as &$prop){
              $prop->setAccessible(true);

              $key=$prop->getName();
              $val=$prop->getValue($obj);
              
              $com=$prop->getDocComment();

              // if comments is exist
              if ($com){
                  $pos=\strpos($com,'@');

                  // if this comment is an ODM comment
                  if ($pos!==false){
                      // get an ODM comment
                      \preg_match('/.*@(.+)(\s).*/',$com,$matches);
                      $odmCom=$matches[1];

                      if (\preg_match('/[date|string|int]/i',$odmCom)){
                          switch ($odmCom) {
                              case 'date':
                                  $val=$this->prepareDate($val);
                                  break;
                              }
                      }

                      if (\preg_match('/referenceMany/i',$odmCom)){
                          // we have an array of objects
                          // example: post.comments
                          // item instanceof Comment extends DataObject
                          $arr=array();

                          foreach($val as $item){
                              var_dump($item);
                              $doc=$this->buildDocumentFromObject($item);
                              $arr[]=$doc;
                          }

                          $val=$arr;
                      }
                  }
              }
              
              $document[$key]=$val;
          }
          
          return $document;
        }

        public function buildObjectFromDocument($document){
            
        }

        public function prepareId($id){
            return (\gettype($id)=='string')? new \MongoId($id): $id;
        }

        public function prepareDate($date){
            if (\gettype($date)=='string'){
                $dt=new MongoDBDate(new StrDate($date));
                return $dt->getDate();
            }else
                return $date;
        }

        // saves an object to this collection
        // if the object is from the database, update the existing database object, otherwise insert this object
        // options: safe, fsync, timeout
        public function save($collectionName, DataObject $obj, $options = array('safe' => true)){
            $collection = $this->db->selectCollection($collectionName);
            $document = $this->buildDocumentFromObject($obj);

            // TODO release exception handler
            $collection->save($document,$options);
            return true;
        }

        // inserts an object into the collection
        public function insert($collectionName, DataObject $obj, $options = array('safe' => true)){
            $collection = $this->db->selectCollection($collectionName);
            $document = $this->buildDocumentFromObject($obj);

            // TODO release exception handler
            try{
                $collection->insert($document,$options);
            }catch(MongoCursorException $e){
                echo $e->getMessage();
            }
            return true;
        }

        // update records based on a given criteria
        public function update($collectionName, $criteria = array(), DataObject $newobj, $options = array()){
            $collection = $this->db->selectCollection($collectionName);
            $newdocument = $this->buildDocumentFromObject($newobj);
            return $collection->update($criteria, $newdocument, $options);
        }

        // remove records from this collection
        public function remove($collectionName, $criteria = array(), $options = array()){
            $collection = $this->db->selectCollection($collectionName);
            $collection->remove($criteria, $options);
            return true;
        }


        // querys this collection
        public function find($collectionName,$query=array(),$fields=array()){
             $collection=$this->db->selectCollection($collectionName);
             return $collection->find($query,$fields);
        }

        // querys this collection, returning a single element
        public function findOne($collectionName,$query = array(), $fields = array()){
             $collection = $this->db->selectCollection($collectionName);
             return $collection->findOne($query,$fields);
        }

        // counts the number of documents in this collection
        public function count($collectionName, $query = array(), $limit = 0, $skip = 0){
            $collection = $this->db->selectCollection($collectionName);
            return $collection->count($query, $limit, $skip);
        }

        public function newCollection($name){
            return new \MongoCollection($this->db,$name);
        }
        
        public function ensureIndex($collectionName,$keys,$options=array()){
             $collection = $this->db->selectCollection($collectionName);
             $collection->ensureIndex($keys,$options);
        }
    }
?>
