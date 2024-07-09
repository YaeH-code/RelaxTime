<?php
require_once "models/UserManager.php";

class AuthController{
    private $userManager;
    public function __construct(){
        $this->userManager = new userManager;
    }
    public function alertFormSignup(){
        switch(!empty($_POST))
        {
            case(!isset($_POST['name']) || strlen($_POST['name']) < 1):
                $_SESSION['alert'] = [
                    "type" => "danger",
                    "msg" => "Enter your name"
                ];
                header('Location: '. URL . "signup");
            break;
            case(!isset($_POST['email']) || filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false):
                $_SESSION['alert'] = [
                    "type" => "danger",
                    "msg" => "Your e-mail is not good"
                ];
                header('Location: '. URL . "signup");
            break;
            case(!isset($_POST['password']) || !ctype_alnum($_POST['password']) || strlen($_POST['password']) < 1):
                // $error = true;
                $_SESSION['alert'] = [
                    "type" => "danger",
                    "msg" => "Enter your password"
                ];
                header('Location: '. URL . "signup");
            break;
            case(strlen($_POST['password']) < 8):
                $_SESSION['alert'] = [
                    "type" => "danger",
                    "msg" => "Your password should be more than 8 letters"
                ];
                header('Location: '. URL . "signup");
            break;
            case(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && strlen($_POST['password']) > 7):
                $role='user';
                $password = $_POST['password'];
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->userManager->creatAccountBd($_POST['name'],$_POST['email'],$hashPassword,$role);
        
                $_SESSION['alert'] = [
                    "type" => "success",
                    "msg" => "Please login " . $_POST['name'] . "!"
                ];
        
                header('Location: '. URL . "login");
            break;
            default:
            throw new Exception("Not validated");
        }
    }
    public function login(){
        switch(!empty($_POST)){
            case(!isset($_POST['email']) || filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false) :
                $_SESSION['alert'] = [
                    "type" => "danger",
                    "msg" => "Your e-mail is not good"
                ];
                header('Location: '. URL . "login");
            break;
            case(!isset($_POST['password']) || !ctype_alnum($_POST['password']) || strlen($_POST['password']) < 8) :
                $_SESSION['alert'] = [
                    "type" => "danger",
                    "msg" => "Your password is not good"
                ];
                header('Location: '. URL . "login");
            break;
            case(isset($_POST['email']) && isset($_POST['password'])):
                $this->userManager->checkingAccountBd();
                if(!isset($_SESSION['name'])){
                    $_SESSION['alert'] = [
                        "type" => "danger",
                        "msg" => "Your account is not good"
                    ];
                    header('Location: '. URL . "login");
                }else{
                    $_SESSION['alert'] = [
                        "type" => "success",
                        "msg" => "Hello " . $_SESSION['name'] . "!"
                    ];
            
                    header('Location: '. URL . "home");
                }
            break;
            default :
                $_SESSION['name'] == null;
                $_SESSION['alert'] = [
                    "type" => "alert",
                    "msg" => "You can start to signUp !"
                ];
                header('Location: '. URL . "home");
        }
    }
    public function logout(){
        session_start();
        session_destroy();

        header('Location: '. URL . "home");
        exit();
    }

    public function sendMail(){
        // Mail::to('phpisbetterthanjava@gmail.com')->send(new YourMailableClass([]));
    }
}