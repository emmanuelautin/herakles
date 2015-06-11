<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author autin
 */
class Controller {
    
    //charge le modèle demandé.
    public function model($model)
    {
        require_once ROOT.'models/'.$model.'.php';
        return new $model();
    }
    
    //charge la vue demandée
    public function view($view, $data = null, $more = null)
    {
        require_once ROOT. 'views/'.$view; 
    }
    
    public function viewMore($view, $data = null, $more = null, $must = null, $musten = null, $musteen = null){
        
           require_once ROOT. 'views/'.$view; 
    }
    
    
}

?>
