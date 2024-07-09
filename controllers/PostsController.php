<?php
require_once "models/PostManager.php";
require_once "models/CommentManager.php";
require_once "models/CategoryManager.php";
require_once "models/UserManager.php";

class PostsController{
    private $postManager;
    private $commentManager;
    private $categoryManager;
    private $userManager;
    public function __construct(){
        $this->postManager = new postManager;
        $this->commentManager = new commentManager;
        $this->categoryManager = new categoryManager;
        $this->userManager = new userManager;
        $this->postManager->chargementPosts();// on charge tous les libre de la bdd des le constructeur
        $this->commentManager->chargementComments();
        $this->categoryManager->chargementCategories();
        $this->userManager->chargementUsers();
    }

    public function showPosts(){
        $posts = $this->postManager->getPosts();
        $categories = $this->categoryManager->getCategories();
        require "views/posts.view.php";// on stock la liste des posts dans $posts et on selectionne le template pour les afficher
    }
    public function showPostsByCat($catId){ 
        if (array_key_exists('name', $_SESSION) !== TRUE){
            header('Location: '. URL . "signup");
        }else{
            $category = $this->categoryManager->getCategoryById($catId);
            if($this->postManager->getCatById($catId) !== ''){
                $posts = $this->postManager->getCatById($catId);
            }
        }
        require "views/showPostsByCategory.view.php";
    }
    public function showPost($id){ 
        if (array_key_exists('name', $_SESSION) !== TRUE){
            header('Location: '. URL . "signup");
        }else{
            $post = $this->postManager->getPostById($id);
            $categories = $this->categoryManager->getCategories();
            $users = $this->userManager->getUsers();
            if($this->commentManager->getCommentsById($id) !== ''){
                    $comments = $this->commentManager->getCommentsById($id);
            }
        }
        require "views/showPost.view.php";
    }

    public function creatNewPost(){
        if (array_key_exists('name', $_SESSION) !== TRUE){
            header('Location: '. URL . "signup");
        }else{
            $categories = $this->categoryManager->getCategories();
        }
        require "views/creatPost.view.php";
    }
    public function creatPostValidation(){
        $user = $_SESSION['id'];
        $time = '';
        if($_FILES['img']['name'] !== ''){
            $file = $_FILES['img'];
            $repertoire = "public/images/";
            $nameImage = $this->insertImage($file,$repertoire);
        }else{
            $nameImage = "dummy-image-square.jpg";
        }
        $this->postManager->creatPostBd($_POST['title'],$_POST['content'],$nameImage,$time,$_POST['category'],$user);
        
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "New article !"
        ];
        
        header('Location: '. URL . "articles");
    }

    public function deletePost($id){
        $nomImage = $this->postManager->getPostById($id)->getImage();
        if($nomImage !== "dummy-image-square.jpg"){
            unlink("public/images/".$nomImage);
            $this->postManager->deletePostBD($id);
        }else{
            $this->postManager->deletePostBD($id);
        }
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Deleted !"
        ];
        header('Location: '. URL . "articles");
    }

    public function modificationPost($id){
        if (array_key_exists('name', $_SESSION) !== TRUE){
            header('Location: '. URL . "signup");
        }else{
            $categories = $this->categoryManager->getCategories();
            $post = $this->postManager->getPostById($id);
        }
        require "views/modifyPost.view.php";
    }

    public function modificationPostValidation(){
        $imageActuelle = $this->postManager->getPostById($_POST['identifiant'])->getImage();
        $file = $_FILES['img'];

        if($file['size'] > 0){
            unlink("public/images/".$imageActuelle);
            $repertoire = "public/images/";
            $nomImageToAdd = $this->insertImage($file,$repertoire);
        } else {
            $nomImageToAdd = $imageActuelle;
        }
        $this->postManager->modificationPostBD($_POST['identifiant'],$_POST['title'],$_POST['content'],$nomImageToAdd,$_POST['category']);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Updated !"
        ];
        
        header('Location: '. URL . "articles");
    }

    private function insertImage($file, $dir){
        if(!isset($file['name']) || empty($file['name']))
            throw new Exception("You must enter an image");
    
        if(!file_exists($dir)) mkdir($dir,0777);
    
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];
        
        if(!getimagesize($file["tmp_name"]))
            throw new Exception("It's not the good file");
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("This file extension is not recognized");
        if(file_exists($target_file))
            throw new Exception("This file still exist");
        if($file['size'] > 100000000)
            throw new Exception("This file is too big");
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("Sorry, it doesn't work");
        else return ($random."_".$file['name']);
    }

    // comments
    public function creatCommentValidation($id){
        if (array_key_exists('name', $_SESSION) !== TRUE){
            header('Location: '. URL . "signup");
        }else{
                $user_id = $_SESSION['id'];
                $this->commentManager->creatCommentBd($_POST['comment'], $_POST['post_id'],$user_id);
                
                $_SESSION['alert'] = [
                    "type" => "success",
                    "msg" => "New comment !"
                ];
                header('Location: '. URL . "articles" ."/p/" . $_POST['post_id']);
        }
    }
    public function deleteComment($id){
            $this->commentManager->deleteCommentBD($id);
            $_SESSION['alert'] = [
                "type" => "success",
                "msg" => "Deleted your comment !"
            ];
            header('Location: '. URL .  "articles" . "/p/" . $_POST['post_id']);
    }
    // Page Admin
    public function allPosts(){
        if (array_key_exists('name', $_SESSION) !== TRUE){
            header('Location: '. URL . "signup");
        }else{
            $posts = $this->postManager->getPosts();
            $categories = $this->categoryManager->getCategories();
        }
        require "views/allPosts.view.php";// on stock la liste des posts dans $posts et on selectionne le template pour les afficher
    }
    public function adminPage(){
        if (array_key_exists('name', $_SESSION) !== TRUE || $_SESSION['role'] !== 'admin'){
            header('Location: '. URL . "signup");
        }else{
            $posts = $this->postManager->getPosts();
            $categories = $this->categoryManager->getCategories();
            $users = $this->userManager->getUsers();
        }
        require "views/adminPage.view.php";// on stock la liste des posts dans $posts et on selectionne le template pour les afficher
    }
    public function creatCatValidation(){
        if ($_SESSION['role'] !== 'admin'){
            header('Location: '. URL . "signup");
        }else{
            $date = "";
            $this->categoryManager->creatCatBd($_POST['cat'], $date);
            $_SESSION['alert'] = [
                "type" => "success",
                "msg" => "New category !"
            ];
            header('Location: '. URL . "admin" );
        }
    }
    public function deleteCatValidation($id){
        if ($_SESSION['role'] !== 'admin'){
            header('Location: '. URL . "signup");
        }else{
        $this->categoryManager->deleteCatBD($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Deleted un category !"
        ];
        header('Location: '. URL .  "admin");
        }
    }
    public function deleteUserValidation($id){
        if ($_SESSION['role'] !== 'admin'){
            header('Location: '. URL . "signup");
        }else{
        $this->userManager->deleteUserBD($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Deleted un user !"
        ];
        header('Location: '. URL .  "admin");
        }
    }
    public function modificationUser($id){
        if ($_SESSION['role'] !== 'admin'){
            header('Location: '. URL . "signup");
        }else{
            $user = $this->userManager->getUserById($id);
        }
        require "views/modifyUser.view.php";
    }
    public function modificationUserValidation(){
        if ($_SESSION['role'] !== 'admin'){
            header('Location: '. URL . "signup");
        }else{
        $password = $_POST['password'];
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->userManager->modificationUserBD($_POST['user_id'],$_POST['name'],$_POST['email'],$hashPassword,$_POST['role']);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Updated !"
        ];
        
        header('Location: '. URL . "admin");
        }
    }
}
