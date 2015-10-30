<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author autin
 */
class Login extends Controller {
    /* Appel par défaut si méthode non trouvée */

    public function index() {
        //envoi donnée a la vue. 
        $this->view('login/loginView.php');
    }

    public function logUser() {


        if (isset($_POST['loginUser'])) {
            $pass = $_POST['pwdUser'];
            $user = $_POST['nameUser'];
            $loginModel = $this->model('LoginModel');

            if ($loginModel->validateLogin($user, $pass)) {

                $this->startSession($user);
                   $defautModel =  $this->model('DefautModel');
                    //recuperation donnée via le model
                    $customers = $defautModel->getCustomers();
                $this->view('defaut/defautView.php', $customers);
            } else {

                $errorMessage = "<b>Erreur de connexion</b>";
                $this->view('login/loginView.php', $errorMessage);
            }
        } else {
            $this->view('login/loginView.php');
        }
    }

    public function startSession($user){
        
        $loginModel = $this->model('LoginModel');
        $role = $loginModel->getRole($user);
        
      
        $_SESSION['name'] = $user;
        $_SESSION['role'] = $role;
        
    }
    
    public function keepSession(){
        
         session_start();
    }
    
    public function logout(){
        
         // Démarrage ou restauration de la session
            //session_start();
         // Réinitialisation du tableau de session
         // On le vide intégralement
         $_SESSION = array();
        // Destruction de la session
        session_destroy();
        // Destruction du tableau de session
        unset($_SESSION);
        // charge vu de connexion
        $this->view('login/loginView.php');
    }

}

?>
