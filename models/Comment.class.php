<?php
class Comment{ 
    private $id;
    private $comment;
    private $post_id;
    private $user_id;

    public function __construct($id,$comment,$post_id,$user_id){
        $this->id = $id; 
        $this->comment = $comment;
        $this->post_id = $post_id;
        $this->user_id = $user_id;
    }


    public function getId(){     
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }

    public function getComment(){
        return $this->comment;
    }

    public function setComment($comment){
        $this->comment = $comment;
    }
    
    public function getPost_id(){
        return $this->post_id;
    }
    
    public function setPost_id($post_id){
        $this->post_id = $post_id;
    }
    public function getUser_id(){
        return $this->user_id;
    }

    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }
  }