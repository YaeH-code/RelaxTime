<?php
session_start();

// on va definir un chemin absolut par defaut qui par systematiquement de la racine
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]")); /* server de php self renvoie la page actuel
/* on a donc tableau 
        exemple: biblio/acueil/xxx/  
        INDEX:     0   /   1  / 2 /    etc */
require_once "controllers/PostsController.php";
require_once "controllers/AuthController.php";
$postController = new PostsController;
$authController = new AuthController;

try{ 
    if(empty($_GET['page'])){
        require "views/home.view.php";
    } else { 
        $url = explode("/", filter_var($_GET['page']),FILTER_SANITIZE_URL);
            MainRoute($url, $postController, $authController);
        }
}
catch(Exception $e){
    $msg = $e->getMessage();
    require "views/error.view.php";
}
// a la place des if else on peut mettre un switch dans un switch


function MainRoute($url, $postController, $authController)
{
    switch($url[0]){// on vas tester tous les 
        case "home" : require "views/home.view.php";
        break;
        case "articles" : 
            ArticlesRoute($url, $postController);
        break;
        case "login" : 
            if(empty($url[1])){
                require "views/login.view.php";
            }else if($url[1] === "lv"){
                $authController->login();
            }else if($url[1] === "pw"){
                $authController->sedMail();
            }
        break;
        case "logout" : 
                $authController->logout();
            require "views/home.view.php";
            break;
        case "signup" :
            if(empty($url[1])){
                require "views/creatAccount.view.php";
            }else if($url[1] === "sv"){
                $authController->alertFormSignup();
            }
        break;
        case "admin" : 
            if(empty($url[1])){
                $postController->adminPage();
            }else if($url[1] === "adv"){
                $postController->creatCatValidation();
            }else if($url[1] === "addcv"){
                $postController->deleteCatValidation($url[2]);
            }else if($url[1] === "adm"){
                $postController->modificationUser($url[2]);
            }else if($url[1] === "admv"){
                $postController->modificationUserValidation();
            }else if($url[1] === "adduv"){
                $postController->deleteUserValidation($url[2]);
            }
        break;
        default : throw new Exception("This page doesn't exist");
    }
}
    function ArticlesRoute($url, $postController)
    {
        switch ($url)
        {
            case empty($url[1]):
                $postController->showPosts();
                break;
            case $url[1] === "p":
                $postController->showPost($url[2]);
                break;
            case $url[1] === "c":
                $postController->creatNewPost();
                break;
            case $url[1] === "m":
                $postController->modificationPost($url[2]);
                break;
            case $url[1] === "d":
                $postController->deletePost($url[2]);
                break;
            case $url[1] === "av":
                $postController->creatPostValidation();
                break;
            case $url[1] === "mv":
                $postController->modificationPostValidation();
                break;
            case $url[1] === "cm":
                $postController->creatCommentValidation($url[2]);
                break;
            case $url[1] === "dc":
                $postController->deleteComment($url[2]);
                break;
            case $url[1] === "category":
                $postController->showPostsByCat($url[2]);
                break;
            case $url[1] === "all":
                $postController->allPosts();
                break;
        }
    }