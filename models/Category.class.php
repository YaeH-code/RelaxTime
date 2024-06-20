<?php
class Category{ 
    private $id;
    private $name;
    private $date;

    public function __construct($id,$name,$date){
        $this->id = $id; 
        $this->name = $name;
        $this->date = $date;
    }


    public function getId(){     
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }

    public function getCat(){
        return $this->name;
    }

    public function setCat($name){
        $this->name = $name;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }
  }