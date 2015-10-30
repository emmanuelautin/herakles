<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author autin
 */
class UserModel{
    
    public $nom;
    public $prenom;
    
      private function getBdd(){
        
    $bdd = new PDO('mysql:host=localhost;dbname=herakles;charset=utf8', 'root',
      '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
    
  }
    
    public function getUsers(){
        
        
        $bdd = $this->getBdd();
        $req = $bdd->prepare("SELECT * FROM user");
        $users = $req->execute();
        return $users; 
    }
   
    
}

?>
