<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of App
 *
 * @author autin
 */
class App {
    
  private $_controller = 'defaut';
  private $_method = 'index';
  private $_params = [];
  
  public function __construct()
  {
      $url = $this->parseUrl();
      
      // le premier element url constitue le controller
      // si le fichier existe dans le folder controller
      if(file_exists(ROOT.'/controllers/'.$url[0].'.php'))
      {
      // on definit l'attribut controller de objet App a être ce controller. 
      $this->_controller = $url[0];
      //on vide array url 
      unset($url[0]);
      }
      
      // on require le fichier de ce controller. 
      require_once ROOT.'controllers/'.$this->_controller.'.php';
      // on instancie un controller dans l'attribut controller de app
      $this->_controller = new $this->_controller;
      
      // si le tableau url contient un param 2 c'est la méthode: 
      if(isset($url[1]))
      {
          
          // on teste si la méthode existe dans l'objet
          if(method_exists($this->_controller, $url[1]))
          {
              $this->_method = $url[1];
            
              unset($url[1]);
          }
        
      }
      

       
      //parametres sous forme array si present sinon vide
      $this->_params = $url ? array_values($url) : [];
      

      
      // fait : $controllerObjet->methode($params)
      // ici $default->index($params); 
      call_user_func_array([$this->_controller, $this->_method], [$this->_params]);
      
  }
  
  public function parseUrl()
  {
      //on récupére url 
      if(isset($_GET['url'])){ 
      //on recupere chaque element de l'url dans un array
      $url = explode('/', filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
       // on retourne url 
      

      return $url; 
      
      }
  }
  
}

?>
