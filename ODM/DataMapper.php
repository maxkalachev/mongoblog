<?php
    namespace MongoBlog\ODM;

    abstract class DataMapper{
        protected $dm;
        protected $collectionName;

        public function __construct($collectionName){
            $this->collectionName=$collectionName;
        }

        public function setDM($dm){
            $this->dm=$dm;
        }

        public function add(DataObject $obj){
            return $this->dm->save($this->collectionName,$obj);
        }

        public function updateData($id,DataObject $newobj){
            return $this->dm->update($this->collectionName,array('_id'=>$this->dm->prepareId($id)),$newobj);
        }

        public function delete($id){
            return $this->dm->remove($this->collectionName,array('_id'=>$this->dm->prepareId($id)));
        }

        public function findById($id){

            return $this->dm->find($this->collectionName,array('_id'=>$this->dm->prepareId($id)));
        }

        public function findAll(){
            return $this->dm->find($this->collectionName,array());
        }

        public function findByField($query,$fields=array()){
             return $this->dm->findOne($this->collectionName,$query,$fields);
        }

        public function findValue($query,$field){
            $cursor=$this->dm->findOne($this->collectionName,$query,$field);
            return $cursor[$field[0]];
        }
    }
?>
