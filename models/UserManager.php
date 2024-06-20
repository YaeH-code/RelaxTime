<?php
require_once "Model.class.php";
require_once "User.class.php";

class UserManager extends Model{
    private $users;//tableau

    public function creatUser($user){
      $this->users[] = $user;
  }
  
  public function getUsers(){
      return $this->users;
  }
  public function chargementUsers(){
      $req = $this->getBdd()->prepare("SELECT * FROM users ORDER BY name");
      $req->execute();
      $myusers = $req->fetchAll(PDO::FETCH_ASSOC);
      $req->closeCursor();// fermer le curseur permet de finaliser la requete et de liberer les acces a la bdd pour une autre requete

      foreach($myusers as $user){
          $l = new User($user['id'],$user['name'],$user['email'],$user['password'],$user['role']);
          $this->creatUser($l);
      }
  }    
  public function getUserById($id){
      for($i=0; $i < count($this->users);$i++){
          if($this->users[$i]->getId() == $id){
              return $this->users[$i];
          }
      }
      throw new Exception("Nobody");
  }

  public function creatAccountBd($name,$email,$password,$role){
    $req = "
    INSERT INTO users (name,email,password,role)
    values (:name, :email, :password, :role)";
    $stmt = $this->getBdd()->prepare($req);
    $stmt->bindValue(":name",$name,PDO::PARAM_STR);
    $stmt->bindValue(":email",$email,PDO::PARAM_STR);
    $stmt->bindValue(":password",$password,PDO::PARAM_STR);
    $stmt->bindValue(":role",$role,PDO::PARAM_STR);
    $resultat = $stmt->execute();
    $stmt->closeCursor();

    if($resultat > 0){
        $user = new User($this->getBdd()->lastInsertId(),$name,$email,$password,$role);
        $this->creatUser($user);
    }        
    }
    public function checkingAccountBd(){
        $req1 = '
        SELECT 
        *
        FROM users
        WHERE email = :email';
    $stmt = $this->getBdd()->prepare($req1);
    $stmt->bindParam(":email",$_POST['email'],PDO::PARAM_STR);
    $resultat = $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
        if($resultat > 0){
            if(password_verify($_POST['password'],$user['password'])){
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
            }
        }else{
            $_SESSION['alert'] = [
                "type" => "danger",
                "msg" => "Your account is not good"
            ];
            header('Location: '. URL . "login");
        }
    }
    public function logout(){
        session_start();
        session_destroy();

        header('Location: '. URL . "home");
        exit();
    }
    public function deleteUserBD($id){
        $req = "
        Delete from users where id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $users = $this->getUserById($id);
            unset($users);
        }
    }
    public function modificationUserBD($id,$name,$email,$password,$role){
        $req = "
        UPDATE users 
        SET name = :name, email = :email, password = :password, role = :role
        WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->bindValue(":name",$name,PDO::PARAM_STR);
        $stmt->bindValue(":email",$email,PDO::PARAM_STR);
        $stmt->bindValue(":password",$password,PDO::PARAM_STR);
        $stmt->bindValue(":role",$role,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $this->getUserById($id)->setName($name);
            $this->getUserById($id)->setEmail($email);
            $this->getUserById($id)->setPassword($password);
            $this->getUserById($id)->setRole($role);
        }
    }
}