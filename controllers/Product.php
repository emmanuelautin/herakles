<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author autin
 */
class Product extends Controller {
    //put your code here
    private $productId;
    
     /*Appel par défaut si méthode non trouvée */ 
    public function index($params){
        
      $this->params = $params;  
       //charge le modele par defaut : 
      $ProductModel =  $this->model('ProductModel');
      //recuperation donnée via le model
      $products = $ProductModel->getProducts();
     
      //envoi donnée a la vue. 
      $this->view('product/viewProduct.php', $products);
     
    }
    
    public function editProduct($id){
        
      $this->productId = implode($id); 
      //charge le modele defaut 
      $ProductModel =  $this->model('ProductModel');
      //recuperation donnée du customer via model
      $product = $ProductModel->getProductInfo($this->productId);
      //envoi donnée a la vue. 
      $categorys = $ProductModel->getCategorys();
      
      $this->view('product/viewAdminEditProduct.php', $product, $categorys);
        
    }
    
     public function saveProduct(){
      
        $data = $_POST;
        extract($_POST); // transforme array en variables clés valeur. 
        $this->productId = $productId;
       
        $productModel = $this->model('ProductModel');
        
        /*on effectue l'update */ 
        
        $productModel->updateProduct($data);
        
        /* on recharge la vue */
        $product = $productModel->getProducts();
        $this->view('product/viewProduct.php', $product);
    }
    
    
    
      public function addProduct(){
    
        if(!sizeof($_POST)){
        // si rien de posté, on affiche la saisie. 
            $productModel = $this->model('ProductModel');
            $categorys = $productModel->getCategorys(); 
            $this->view('product/viewAddProduct.php',$products = null, $categorys);
            
        }elseif(isset($_POST['addProduct'])){
            
            $data = $_POST;
            $productModel = $this->model('ProductModel');
            $productModel->addProduct($data);
            $products = $productModel->getProducts();
            $this->view('product/viewProduct.php',$products);
        }else{
       

            $this->view('product/viewProduct.php');
        }
         
    }
    
      public function deleteProduct($productId){
          
          $productModel = $this->model('ProductModel');
          $productModel->deleteProduct($productId);
          $products = $productModel->getProducts();
          $this->view('product/viewProduct.php', $products);
    }
    
    
    
     public function addCategory(){
         
         $productModel = $this->model('ProductModel');
         if(!sizeof($_POST)){
              $categorys = $productModel->getCategorys();
              $this->view('product/viewAddCategory.php', $categorys);
         }elseif(isset($_POST['addCategory'])){
             
             $data = $_POST;
             $productModel->addCategory($data);
             $categorys = $productModel->getCategorys();
             $this->view('product/viewAddCategory.php', $categorys);
             
         }else{
             $this->view('product/viewAddCategory.php', $categorys);
         }
              
    }
    
    public function editCategory($categoryId){
        
        if(!sizeof($_POST)){
            
            $id = $categoryId;
            $productModel = $this->model('ProductModel');
            $category = $productModel->getCategory($id);
            $this->view('product/viewEditCategory.php', $category);
            
        }elseif(isset($_POST['editCategory'])){
            
             $data = $_POST;
             $productModel = $this->model('ProductModel');
             $productModel->updateCategory($data);
             $categorys = $productModel->getCategorys();
             $this->view('product/viewAddCategory.php', $categorys);
                     
        }else{
            $this->view('product/viewAddCategory.php', $categorys);
        }
    
    }
    
    public function deleteCategory($categoryId){
        
        $productModel = $this->model('ProductModel');
        $productModel->deleteCategory($categoryId);
        $categorys = $productModel->getCategorys();
        $this->view('product/viewAddCategory.php', $categorys);
        
    }
    
    
    
   
    
    
}

?>
