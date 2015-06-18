<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @author autin
 */

//namespace controllers\user; 


class User extends Controller{
    //put your code here
    
  
      public function index($params){
        
    
       //charge le modele par defaut : 
      $userModel = $this->model('UserModel');
      //recuperation donnée via le model
      $users = $userModel->getUsers();
     
      //envoi donnée a la vue. 
      $this->view('user/viewUserDefaut.php', $users);
     
    }
    
    
}

?>
