<?php
class Post{ 
    private $id;
    private $title;
    private $content;
    private $img;
    private $time;
    private $category;
    private $user;
    public function __construct($id,$title,$content,$img,$time,$category,$user){
        $this->id = $id; 
        $this->title = $title;
        $this->content = $content;
        $this->img = $img;
        $this->time = $time;
        $this->category = $category;
        $this->user = $user;
    }


    public function getId(){     
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
    }

    public function getImage(){
        return $this->img;
    }

    public function setImage($img){
        $this->img = $img;
    }
    public function getTime(){
        return $this->time;
    }

    public function setTime($time){
        $this->time = $time;
    }
    public function getCategory(){
        return $this->category;
    }

    public function setCategory($category){
        $this->category = $category;
    }
    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }
}