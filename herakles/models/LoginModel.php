<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginModel
 *
 * @author autin
 */
class LoginModel {
    //put your code here
       private function getBdd(){
        
    $bdd = new PDO('mysql:host=localhost;dbname=herakles;charset=utf8', 'root',
      '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
    
  }
    
    public function validateLogin($user, $pass){
        
        $bdd = $this->getBdd();
        $req = $bdd->prepare("SELECT * FROM user WHERE login = :login AND password = :password");
        $req->bindValue(':login', $user);
        $req->bindValue(':password', $pass);
        $req->execute();
        if($req->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    
    
    public function getRole($user){
        
        $bdd = $this->getBdd();
        $req = $bdd->prepare("SELECT id_type FROM user WHERE login = :login");
        $req->bindValue(':login', $user);
        $req->execute();
        if($req->rowCount() > 0){
            $idType = $req->fetchAll(PDO::FETCH_ASSOC);
            $idType = $idType[0]['id_type'];
            $req = $bdd->prepare("SELECT name FROM type WHERE id = :id");
            $req->bindValue(':id', $idType);
            $req->execute();
            if($req->rowCount() > 0){
                $name = $req->fetchAll(PDO::FETCH_ASSOC);
                $nameRole = $name[0];
                $nameRole = $nameRole['name'];
           
                return $nameRole;
            }
            
    }
}


}
