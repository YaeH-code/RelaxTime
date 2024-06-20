<?php
require_once "Model.class.php";
require_once "Comment.class.php";

class CommentManager extends Model{
    private $comments;

    public function creatComment($comment){
        $this->comments[] = $comment;
    }
    public function getComments(){
        return $this->comments;
    }

    public function chargementComments(){
        $req = $this->getBdd()->prepare("SELECT * FROM comments");
        $req->execute();
        $mycomments = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();// fermer le curseur permet de finaliser la requete et de liberer les acces a la bdd pour une autre requete

        foreach($mycomments as $comment){
            $l = new Comment($comment['id'],$comment['comment'],$comment['post_id'],$comment['user_id']);
            $this->creatComment($l);
        }
    }
    public function getCommentsById($id){
        for($i=0; $i < count($this->comments);$i++){
            if($this->comments[$i]->getPost_id() == $id){
                return $this->comments;
            }
        }
    }
    public function creatCommentBd($comment,$post_id,$user_id){
        $req = "
        INSERT INTO comments (comment, post_id, user_id)
        values (:comment, :post_id, :user_id)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":comment",$comment,PDO::PARAM_STR);
        $stmt->bindValue(":post_id",$post_id,PDO::PARAM_INT);
        $stmt->bindValue(":user_id",$user_id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $comment = new Comment($this->getBdd()->lastInsertId(),$comment,$post_id,$user_id);
            $this->creatComment($comment);
        }        
    }
    public function deleteCommentBD($id){
        $req = "
        Delete from comments where id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $comments = $this->getCommentsById($id);
            unset($comments);
        }
    }
  }