<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderModel
 *
 * @author autin
 */
class OrderModel extends Exception{
    
    private $tva = 20; 
    private $full = 0;
    
       private function getBdd(){
        
    $bdd = new PDO('mysql:host=localhost;dbname=herakles;charset=utf8', 'root',
      '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
    
  }
  
  
  public function getOrderInfos($orderId){
      
        $orders = $this->getOrders();
        $order = array(); 
        if(is_array($orderId)){
             $orderId = $orderId[0];
        }

        foreach ($orders as $order){
          
                    $order['id_statut'] = $orders['commande_'.$orderId]['statut'];
                    $order['id_order'] =  $orders['commande_'.$orderId]['id_commande'];
                    $order['customer_id'] = $orders['commande_'.$orderId]['customer_id'];
                    $order['customer_name'] = $orders['commande_'.$orderId]['customer_name']; 
                    $order['date_add'] = $orders['commande_'.$orderId]['date_add']; 
                    $order['date_edit'] =  $orders['commande_'.$orderId]['date_edit'];
                  
                    
                    // si l'id correspond a ce que l'on cherche, on stoppe et on renvoie au controller
                    if($order['id_commande'] == $orderId)
                    {
                        break;
                    }
                    
        }
        
 
        return $order; 
  }
  
  
  
  public function getProducts($orderId){
      $orderId = $orderId[0];
      $bdd = $this->getBDD();
      $products = $bdd->prepare('SELECT order_product.id_product, order_product.quantity, product.name_product, product.price  FROM order_product JOIN product ON order_product.id_product = product.id WHERE id_order ='.$orderId);
      $products->execute();
        if ($products->rowCount() > 0){

        $products = $products->fetchAll(PDO::FETCH_ASSOC);
        $fullPrice = ''; 
        for($i=0;$i < count($products);$i++){
            
            $priceTTC = $this->calculeTVA($products[$i]['price']);
            $products[$i]['price_TTC'] = $priceTTC;
            $quantity = $products[$i]['quantity'];
            $products[$i]['price_total'] = $this->getTotal($priceTTC,$quantity);
            $fullPrice += $this->getTotal($priceTTC,$quantity);
            $products[$i][] += $fullPrice;
        }
  
       return $products;
      }
  }
  
  
  
  public function updateOrder($orderId,$data){
  
      $orderId = $orderId[0];
      $idCustomer = $data['orderCustomer'];
      unset($data['orderCustomer']);
      $status = $data['orderStatus'];
      unset($data['orderStatus']);
      $productsData = $data;
      $products = array(); 
      $dateEdit = date('Y-m-d H:i:s');
      

      
     foreach($productsData as $productId => $productQuantity){
       if($productQuantity != ''){
         $productId = preg_replace('/fullProductQuantity_/','', $productId);
         $products[$productId] = $productQuantity;
         }
     }
     
     // on stocke historique order dans history_order. 
     
     
     
     
     
     // on mets à jour la commande. 
     
       $bdd = $this->getBDD();
       $update = $bdd->prepare('update `order` set `id_customer`=:id_customer,`date_edit`=:date_edit,`id_status`=:id_status WHERE `id`=:id');
       $update->bindValue(':id_customer',$idCustomer);
       $update->bindValue(':date_edit',$dateEdit);
       $update->bindValue(':id_status',$status);
       $update->bindValue(':id',$orderId);

        if($update->execute()){
            
            // on delete tout ce qui concerne la commande dans order_product
          /*  $select = $bdd->prepare("DELETE FROM order_product WHERE id_order = :id_order ");
            $select->bindValue(':id_order', $orderId);*/
            

                // On insert les nouveaux produits. 
               foreach ($products as $productId => $quantity)
               {
                   
                   $productId = (string)$productId;
                   
                   // on verifie si le produit existe déjà dans la commande. 
                  
                   $verif = $bdd->prepare("Select * FROM order_product WHERE id_order = :id_order AND id_product = :id_product");
                   $verif->bindValue(':id_order', $orderId);
                   $verif->bindValue(':id_product', $productId);
                   $verif->execute();
                   if($verif->rowCount() > 0){
                       // si le produit existe dans la commande, on update sa quantité
                       
                       $update = $bdd->prepare("UPDATE `order_product` SET `id_order` = :id_order, `id_product` = :id_product, `quantity` = :quantity WHERE id_order = :id_order AND id_product = :id_product");
                       $update->bindValue(':id_order', $orderId);
                       $update->bindValue(':id_product', $productId);
                       $update->bindValue(':quantity', $quantity);
                       $update->execute();
                       
                   }else{
                      //sinon on fait une nouvelle insertion. 
                        $insert = $bdd->prepare("INSERT INTO `order_product`(id_order,id_product,quantity) VALUES (:id_order,:id_product,:quantity)");
                        $insert->bindValue(':id_order', $orderId);
                        $insert->bindValue(':id_product', $productId);
                        $insert->bindValue(':quantity', $quantity);
                        $insert->execute();
                   }
                } 
               
               
           
       
            
        }
  }
  
  
  public function calculeTVA($price){
              
      $TTC = $price * (1 + $this->tva/100);
      return $TTC;
  }
  
  
  public function GetTotal($priceTTC, $quantity){
      
      
      $priceTotal = $priceTTC * $quantity;
      
      return $priceTotal;
      
  }
  
 
     public function getOrders(){
        
        $bdd = $this->getBDD();
       $orders = $bdd->prepare('SELECT order.id_status, order_product.id_product as idproduct, order_product.quantity as quantity, order.id as id_order, customer.id as customer_id, customer.raison_sociale as customer_name, date_add as date_add, date_edit as date_edit FROM `order` LEFT JOIN `customer` ON order.id_customer = customer.id LEFT JOIN order_product ON order_product.id_order = order.id ORDER BY id_order');
       $orders->execute();
        if ($orders->rowCount() > 0)
           
             $orders = $orders->fetchAll(PDO::FETCH_ASSOC);
                $products = array (); 
                $idOrders = array(); 
              
                $commandes = array();
                
                $status = $this->getStatus();
                
                
                foreach ($orders as $order){
                       
                   foreach($status as $statu){
                    
                    
                    if($statu['id'] == $order['id_status']){
                        
                        $order['id_statut'] = $statu['name'];
                    }
                }   
                           $commandes['commande_'.$order['id_order']]['statut'] = $order['id_statut'];
                           $commandes['commande_'.$order['id_order']]['id_commande'] = $order['id_order'];
                           $commandes['commande_'.$order['id_order']]['customer_id'] = $order['customer_id'];
                           $commandes['commande_'.$order['id_order']]['customer_name'] = $order['customer_name'];
                           $commandes['commande_'.$order['id_order']]['date_add'] = $order['date_add'];
                           $commandes['commande_'.$order['id_order']]['date_edit'] = $order['date_edit'];
                           $commandes['commande_'.$order['id_order']]['products']['product'.$order['idproduct']]['id'] =  $order['idproduct'];
                           $commandes['commande_'.$order['id_order']]['products']['product'.$order['idproduct']]['quantity'] =  $order['quantity'];  
                           $commandes['commande_'.$order['id_order']]['date_diff'] = $this->getDateDiff($order['id_order']);
                }
                return $commandes; 
     }
    
    
    
    public function getStatus(){
        
        $bdd = $this->getBdd();
        $status = $bdd->prepare("SELECT * FROM status");
        $status->execute();
        return $status->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    public function saveOrder($data){
     
        // récupération id client 
        $customerId = $data['orderCustomer'];
        unset($data['orderCustomer']);
        unset($data['saveOrder']);
        // récupération référence produit et quantité. 
        $products = array(); 
      
        foreach($data as $productId => $productQuantity){
         
         if($productQuantity != ''){
         $productId = preg_replace('/productId-/','', $productId);
         $products[$productId] = $productQuantity;
         }
        
        }
        
        $dateAdd =  date('Y-m-d H:i:s');
        $dateEdit =  date('Y-m-d H:i:s');
       
        $status = '1';
        $bdd = $this->getBdd();
        
        /* on insére la nouvelle commande */ 
        $insert = $bdd->prepare('insert into `order` (id_customer,date_add,date_edit,id_status) VALUES (:id_customer,:date_add,:date_edit,:id_status)');
        $insert->bindValue(':id_customer', $customerId);
        $insert->bindValue(':date_add', $dateAdd);
        $insert->bindValue(':date_edit', $dateEdit);
        $insert->bindValue(':id_status', $status);
        if($insert->execute()){
            
            /*on récupére id de la commande */ 
             $idOrder = $bdd->lastInsertId();
             
             /* on insert les produits dans order_product avec id de la commande. */
              foreach ($products as $id => $quantity){
                
                $insert = $bdd->prepare('INSERT INTO order_product (id_order, id_product,quantity) VALUES (:id_order,:id_product, :quantity)');
                $insert->bindValue(':id_order', $idOrder);
                $insert->bindValue(':id_product', $id);
                $insert->bindValue(':quantity', $quantity);
                $insert->execute();
           } 
            
            
        }

                
        }
        
        public function deleteOrder($orderId){
            
        $bdd = $this->getBdd();
        $id = $orderId[0];
        
        $delete = $bdd->prepare('DELETE FROM `order` WHERE id = :id');
        $delete->bindParam(':id', $id);
      
        
             if($delete->execute()){
            
            // on delete tout ce qui concerne la commande dans order_product
            $select = $bdd->prepare("DELETE FROM order_product WHERE id_order = :id_order ");
            $select->bindValue(':id_order', $id);
            $select->execute();
            
             }
            
        
        }
        
        
        public function getHistory($orderId){
            
        $bdd = $this->getBdd();
        $id = $orderId[0];
        $history = $bdd->prepare("SELECT * FROM order_histo JOIN customer ON order_histo.id_customer = customer.id JOIN status ON order_histo.id_status = status.id WHERE id_order_original = :id");
        $history->bindParam(':id', $id);
        if($history->execute()){
            
               $history =  $history->fetchAll(PDO::FETCH_ASSOC); 
               
              return $history;
        
              
            }
            
        }
        
        // méthode pour calculer le nombre de jours depuis la derniere modification de la commande. 
        public function getDateDiff($orderId){
            $id = (int)$orderId;
            $bdd = $this->getBdd();
            $req = $bdd->prepare("SELECT date_edit FROM `order` WHERE id = :id_order");
           
            $req->bindParam(':id_order', $id);
            $req->execute();
                if($req->rowCount() > 0)
                {
                    $dateEdit = $req->fetchAll(PDO::FETCH_ASSOC);
                    $dateEdit = $dateEdit[0]['date_edit'];
                    $dateEdit = preg_split('/ /',$dateEdit);
                    $dateEdit = $dateEdit[0];
                    $dateDiff = $bdd->prepare("SELECT DATEDIFF( DATE(NOW()), :date_edit ) as nombre_jours");
                    $dateDiff->bindParam(':date_edit', $dateEdit);
                    //$dateDiff->bindParam(':date_now', 'DATE(NOW())');
                    
                    $dateDiff->execute(); 
                    
                     $dateDiff = $dateDiff->fetch();
                   return $dateDiff['nombre_jours'];
                }
                        
                   
                }
                
                
                public function generateDevis($orderId){
                    
                    $orderId = $orderId[0];
                    
                    $orderInfos = $this->getOrderInfos($orderId);
                    
                    
                    var_dump($orderInfos);
                        
                    
                    $customerName = $orderInfos['customer_name'];
                    $dateEdit = date('Y-m-d H:i:s');
        
                    
                    $pdf = new pdf_invoice( 'P', 'mm', 'A4' );
                    $pdf->AddPage();
                    $pdf->addSociete( "Herakles",
                  "2 avenue de Stalingrad\n" .
                  "91120 PALAISEAU\n".
                  "R.C.S. PARIS B 000 000 007\n" .
                  "Capital : 18000 " . EURO );
                    $pdf->fact_dev( "Devis ", "TEMPO" );
                    $pdf->temporaire( "Devis temporaire" );
                    $pdf->addDate( "03/12/2003");
                    $pdf->addClient("CL01");
                    $pdf->addPageNumber("1");
                    $pdf->addClientAdresse("Ste\nM. XXXX\n3ème étage\n33, rue d'ailleurs\n75000 PARIS");
                    $pdf->addReglement("Chèque à réception de facture");
                    $pdf->addEcheance("03/12/2003");
                    $pdf->addNumTVA("FR888777666");
                  //  $pdf->addReference("Devis ... du ....");
                    $cols=array( "REFERENCE"    => 23,
                                 "DESIGNATION"  => 78,
                                 "QUANTITE"     => 22,
                                 "P.U. HT"      => 26,
                                "MONTANT H.T." => 30,
                                "TVA"          => 11 );
                    $pdf->addCols( $cols);
                    $cols=array( "REFERENCE"    => "L",
                                "DESIGNATION"  => "L",
                                "QUANTITE"     => "C",
                                "P.U. HT"      => "R",
                                "MONTANT H.T." => "R",
                                "TVA"          => "C" );
                    $pdf->addLineFormat( $cols);
                    $pdf->addLineFormat($cols);

                $y    = 109;
                $line = array( "REFERENCE"    => "REF1",
                    "DESIGNATION"  => "Carte Mère MSI 6378\n" .
                                 "Processeur AMD 1Ghz\n" .
                                 "128Mo SDRAM, 30 Go Disque, CD-ROM, Floppy, Carte vidéo",
               "QUANTITE"     => "1",
               "P.U. HT"      => "600.00",
               "MONTANT H.T." => "600.00",
               "TVA"          => "1" );
                $size = $pdf->addLine( $y, $line );
                $y   += $size + 2;

                $line = array( "REFERENCE"    => "REF2",
               "DESIGNATION"  => "Câble RS232",
               "QUANTITE"     => "1",
               "P.U. HT"      => "10.00",
               "MONTANT H.T." => "60.00",
               "TVA"          => "1" );
                $size = $pdf->addLine( $y, $line );
                $y   += $size + 2;

                $pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
$tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
                    array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
$tab_tva = array( "1"       => 19.6,
                  "2"       => 5.5);
$params  = array( "RemiseGlobale" => 1,
                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                      "remise"         => 0,       // {montant de la remise}
                      "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                  "FraisPort"     => 1,
                      "portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
                      "portHT"         => 0,       // montant des frais de ports HT
                      "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                  "AccompteExige" => 1,
                      "accompte"         => 0,     // montant de l'acompte (TTC)
                      "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
                  "Remarque" => "Avec un acompte, svp..." );

$pdf->addTVAs( $params, $tab_tva, $tot_prods);
$pdf->addCadreEurosFrancs();
$pdf->Output();
                }
        
        
        }
        
        
        
        
   
    


?>
