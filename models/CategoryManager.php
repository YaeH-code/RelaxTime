<?php
require_once "Model.class.php";
require_once "Category.class.php";

class CategoryManager extends Model{
    private $categories;

    public function creatCategory($category){
        $this->categories[] = $category;
    }
    public function getCategories(){
        return $this->categories;
    }

    public function chargementCategories(){
        $req = $this->getBdd()->prepare("SELECT * FROM categories");
        $req->execute();
        $mycategories = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();// fermer le curseur permet de finaliser la requete et de liberer les acces a la bdd pour une autre requete

        foreach($mycategories as $category){
            $l = new Category($category['id'],$category['name'],$category['created_at']);
            $this->creatCategory($l);
        }
    }
    public function getCategoryById($catId){
        for($i=0; $i < count($this->categories);$i++){
            if($this->categories[$i]->getId() == $catId){
                return $this->categories[$i];
            }
        }
        throw new Exception("No article");
    }
    public function creatCatBd($name, $date){
        $req = "
        INSERT INTO categories (name, created_at)
        values (:name, NOW())";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":name",$name,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $category = new Category($this->getBdd()->lastInsertId(),$name,$date);
            $this->creatCategory($category);
        }        
    }
    public function deleteCatBD($id){
        $req = "
        Delete from categories where id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $categories = $this->getCategoryById($id);
            unset($categories);
        }
    }
}