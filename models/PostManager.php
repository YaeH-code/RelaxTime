<?php
require_once "Model.class.php";
require_once "Post.class.php";
require_once "Comment.class.php";
require_once "CategoryManager.php";
require_once "Category.class.php";

class PostManager extends Model{
    private $posts;//tableau
    public function creatPost($post){
        $this->posts[] = $post;
    }
    
    public function getPosts(){
        return $this->posts;
    }
    public function chargementPosts(){
        $req = $this->getBdd()->prepare("SELECT * FROM posts ORDER BY id DESC");
        $req->execute();
        $myposts = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();// fermer le curseur permet de finaliser la requete et de liberer les acces a la bdd pour une autre requete

        foreach($myposts as $post){
            $l = new Post($post['id'],$post['title'],$post['content'],$post['img'],$post['created_at'],$post['category_id'], $post['user_id']);
            $this->creatPost($l);
        }
    }    
    public function getPostById($id){
        for($i=0; $i < count($this->posts);$i++){
            if($this->posts[$i]->getId() == $id){
                return $this->posts[$i];
            }
        }
        throw new Exception("This article doesn't existe");
    }

    // category
    public function getCatById($id){
        for($i=0; $i < count($this->posts);$i++){
            if($this->posts[$i]->getCategory() == $id){
                return $this->posts;
            }
        }
    }
    // 
    public function creatPostBd($title,$content,$img,$time,$category,$user){
        $req = "
        INSERT INTO posts (title, content, img, created_at, category_id, user_id)
        values (:title, :content, :img, NOW(), :category, :user)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":title",$title,PDO::PARAM_STR);
        $stmt->bindValue(":content",$content,PDO::PARAM_STR);
        $stmt->bindValue(":img",$img,PDO::PARAM_STR);
        $stmt->bindValue(":category",$category,PDO::PARAM_INT);
        $stmt->bindValue(":user",$user,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        
        if($resultat > 0){
            $post = new Post($this->getBdd()->lastInsertId(),$title,$content,$img,$time,$category,$user);
            $this->creatPost($post);
        }        
    }
    
    public function deletePostBD($id){
        $req = "
        Delete from posts where id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $posts = $this->getPostById($id);
            unset($posts);
        }
    }

    public function modificationPostBD($id,$title,$content,$img,$category){
        $req = "
        UPDATE posts 
        SET title = :title, content = :content, img = :img, category_id = :category
        WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->bindValue(":title",$title,PDO::PARAM_STR);
        $stmt->bindValue(":content",$content,PDO::PARAM_STR);
        $stmt->bindValue(":img",$img,PDO::PARAM_STR);
        $stmt->bindValue(":category",$category,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $this->getPostById($id)->setTitle($title);
            $this->getPostById($id)->setTitle($content);
            $this->getPostById($id)->setTitle($img);
            $this->getPostById($id)->setTitle($category);
        }
    }
}