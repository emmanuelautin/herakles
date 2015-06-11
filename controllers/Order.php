<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Order
 *
 * @author autin
 */
class Order extends Controller {
  
    
      public function index($params){
        
      //affiche la page par défaut des commandes. 
      $this->params = $params;  
      $OrderModel =  $this->model('OrderModel');
      $orders = $OrderModel->getOrders();
      $this->view('order/viewOrderDefaut.php', $orders);
     
    }
    
    public function addOrder(){
        
        //affiche la vue pour ajouter une commande 
        $productModel = $this->model('ProductModel');
        $products = $productModel->getProducts(); 
        $defautModel = $this->model('defautModel');
        $customers = $defautModel->getCustomers();
        $this->view('order/viewAddOrder.php', $products, $customers);
        
    }
    
    public function saveOrder(){
        
        //enregistre une nouvelle commande à partir de viewAddOrder.php 
        $data = $_POST;  
        $orderModel = $this->model('OrderModel');
        $orderModel->saveOrder($data); 
        $orders =  $orderModel->getOrders();
        $this->view('order/viewOrderDefaut.php',$orders);
        
    }
    
    public function viewOrder($orderId){

        // affiche la vue du détail pour une commande donnée
        $orderModel = $this->model('OrderModel');
        $orderInfo = $orderModel->getOrderInfos($orderId);
        $productDetail = $orderModel->getProducts($orderId);
        $history = $orderModel->getHistory($orderId);
        $this->viewMore('order/viewViewOrder.php', $orderInfo, $productDetail, $history);
        
    }
    
    public function deleteOrder($orderId){
        
        $orderModel = $this->model('OrderModel');
        $orderDelete = $orderModel->deleteOrder($orderId);
        
        // ajout ici en cours 
        $orders =  $orderModel->getOrders();
        $this->view('order/viewOrderDefaut.php',$orders);
    }
    
    
    public function editOrder($orderId){
        
        // affiche la page edition pour une commande donnée 
        $orderModel = $this->model('OrderModel');
        $orderInfo = $orderModel->getOrderInfos($orderId);
        $productDetail = $orderModel->getProducts($orderId);
        $defautModel =  $this->model('DefautModel');
        $customers = $defautModel->getCustomers();
        $products = $this->model('ProductModel')->getProducts();
        $status = $orderModel->getStatus();
        
        $this->viewMore('order/viewEditOrder.php', $orderInfo, $productDetail, $customers, $products, $status);
    }
    
    public function updateOrder($orderId){
        
        //enregistre la mise a jour d'une commande. 
        $orderModel = $this->model('OrderModel');
        $orderModel->updateOrder($orderId, $_POST);
        $orders = $orderModel->getOrders();
        $this->view('order/viewOrderDefaut.php', $orders);
        
    }
    
    
}

?>
