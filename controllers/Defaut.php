<?php

/*Controlleur Defaut gère toutes les fonctionnalités des clients */ 

class Defaut extends Controller{
    
    private $params;
    private $customerId;
    

        
    public function editCustomer($id){
        
      $this->customerId = implode($id); 
      //charge le modele defaut 
      $defautModel =  $this->model('DefautModel');
      //recuperation donnée du customer via model
      $customer = $defautModel->getCustomerInfo($this->customerId);
      //envoi donnée a la vue. 
      $this->view('defaut/viewAdminEditCustomer.php', $customer);
       
        
    }
    
    public function deleteCustomer($customerId){
          
          $defautModel = $this->model('DefautModel');
          $defautModel->deleteCustomer($customerId);
          $customers = $defautModel->getCustomers();
          $this->view('defaut/defautView.php', $customers);
    }
    
    public function saveCustomer(){
      
        $data = $_POST;
        extract($_POST); // transforme array en variables clés valeur. 
        $this->customerId = $customerId;
        $defautModel = $this->model('DefautModel');
        
        /*on effectue l'update */ 
        
        $defautModel->updateCustomer($data);
        
        /* on recharge la vue */
        $customers = $defautModel->getCustomers();
        $this->view('defaut/defautView.php', $customers);
    }
    
    public function addCustomer(){
    
        if(!sizeof($_POST)){
        // si rien de posté, on affiche la saisie. 
            $this->view('defaut/viewAddCustomer.php','');
            
        }elseif(isset($_POST['addCustomer'])){
            
            $data = $_POST;
            $defautModel = $this->model('DefautModel');
            $defautModel->addCustomer($data);
            $customers = $defautModel->getCustomers();
            $this->view('defaut/defautView.php',$customers);
        }else{
       
        //si posté, on charge le modele
            $this->view('defaut/defautView.php');
        }
         
    }
    
    /*Appel par défaut si méthode non trouvée */ 
    public function index($params){
        
      $this->params = $params;  
       //charge le modele par defaut : 
      $defautModel =  $this->model('DefautModel');
      //recuperation donnée via le model
      $customers = $defautModel->getCustomers();
     
      //envoi donnée a la vue. 
      $this->view('defaut/defautView.php', $customers);
     
    }
    
    public function exportCustomer(){ 
        
        $defautModel =  $this->model('DefautModel');
        $exportCSV = $defautModel->exportCustomers();
        
    }
    
    
    public function getHistoryCustomer($idCustomer){
        
        $defautModel =  $this->model('DefautModel');
        $customerHistory = $defautModel->getHistory($idCustomer);
        $this->view('defaut/viewHistoryCustomer.php', $customerHistory);
       
    }
    
    
    public function filterCustomer(){
        
       $productModel =  $this->model('ProductModel');
       $products = $productModel->getProducts();
       $this->view('defaut/viewFilterCustomer.php', $products);
    }
    
    public function filterCustomerByProduct(){

        if(isset($_POST)){
            $productId = $_POST['filteredByProducts'];
            $defautModel =  $this->model('DefautModel');
            $customers = $defautModel->getCustomersByProduct($productId);
            $this->view('defaut/viewFilterCustomerResult.php', $customers);
        }
    }
    
    
 

}

?>
