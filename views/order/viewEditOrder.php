<?php require'/../common/viewHeader.php'; 
$orderInfo = $data;
$Orderproducts = $more; 
$customers = $must; 
$products = $musten; 
$status = $musteen;

$orderStatut = $orderInfo['statut'];
$id = $orderInfo['id_commande'];
$idCustomer = $orderInfo['customer_id'];
$customerName = $orderInfo['customer_name'];
$dateAdd = $orderInfo['date_add'];
$dateEdit = $orderInfo['date_edit'];
//menu administration
require '/../common/viewAdminMenuBar.php'; 


?>

<div class="container">
       
    <div class="row">
        <h2>Editer la commande #<?= $id;?></h2>
            
               
                
       <h3>Produits actuellement dans la commande #<?= $id;?></h3> 
           <div class="col-md-12">
                        <div class="form-group">
                            <table class=" table table-striped">
                                <tr>
                                <th>#</th>
                                <th>Nom du produit</th>
                                <th>Prix</th>
                                <th>Prix TTC</th>
                                <th>Quantité</th>
                                </tr>
                                
                               <?php if($Orderproducts != ""){ ?>
                         <?php foreach($Orderproducts as $history){ ?>
                            
                                <tr>
                                <td><?= $history['id_product']; ?></td>
                                <td><?= $history['name_product']; ?></td>
                                <td><?= $history['price']; ?> € HT</td>
                                <td><?= $history['price_TTC']; ?> € TTC</td>
                                <td><?= $history['quantity'];?></td>
                         
                                </tr>
                         <?php } // endfor ?>
                               <?php } //endif ?>
                           </table>
                        </div>
                        
           </div>
       <h3>Modifier la commande #<?= $id;?></h3> 
        <div class="col-md-12">
       <div class="form-group">
           <form class="form-signin" method="POST" action="<?= MVC_PATH ?>order/updateOrder/<?= $id;?>">
                            <table class=" table table-striped">
                                <tr>
                                <th>#</th>
                                <th>Nom du produit</th>
                                <th>Prix</th>
                                <th>Prix TTC</th>
                                <th>Quantité</th>
                                </tr>
                         <?php foreach($products as $fullProduct){ ?>
                                <tr>
                                <td><?= $fullProduct['id']; ?></td>
                                <td><?= $fullProduct['name_product']; ?></td>
                                <td><?= $fullProduct['price']; ?> € HT</td>
                                <td><?= $fullProduct['price_TTC']; ?> € TTC </td>
  
                                           
                         <?php if($Orderproducts != ""){ ?>
                             
                         <?php foreach($Orderproducts as $history)
                         { ?>
                                
                                <?php
                                $seen = false;
                                if ($history['id_product'] == $fullProduct['id'] && $history['quantity'] != ""){ ?>
                                    <td><input class="form-control"  type="text" name="fullProductQuantity_<?= $fullProduct['id']; ?>" value="<?= $history['quantity']; ?>" /></td>
                              <?php $seen = true; break; } ?>
                                     
                        <?php } ?>
              
                           <?php if($seen == false){ ?>      
                                    <td><input class="form-control"  type="text" name="fullProductQuantity_<?= $fullProduct['id']; ?>" value="" /></td>
                        <?php } ?> 
                                    
                       
                                 
                     <?php }else{ //endif ?>
                             <td><input class="form-control"  type="text" name="fullProductQuantity_<?= $fullProduct['id']; ?>" value="" /></td>       
                     <?php }?>
                                     <?php } ?>
                                </tr>
                   
                           
                           </table>
                        </div>
                  <div class="col-md-6">
                      <div class="form-group">
                            
                            <label for="orderCustomer" >Client</label>
                            
                            <select name="orderCustomer" class="form-control">
                            <?php foreach($customers as $customer){ ?>
                                <option <?php if($idCustomer == $customer['id']){echo 'selected  ';}?>value="<?= $customer['id']?>"><?=$customer['raison_sociale'] ?></option>
                            <?php } ?>
                            </select>
                      </div>
                    </div>
              <div class="col-md-6">
                      <div class="form-group">
                            
                            <label for="orderStatus" >statut de la commande</label>
                            
                            <select name="orderStatus" class="form-control">
                            <?php foreach($status as $statu ){ ?>
                                <option <?php if($orderStatut == $statu['id']){echo 'selected  ';}?>value="<?= $statu['id']?>"><?=$statu['name'] ?></option>
                            <?php } ?>
                            </select>
                      </div>
                    </div>
                    </div>
    </div>
                 <input type="submit" data-toggle="modal" data-target="#modal"  class="btn btn-lg btn-success btn-block" value="Mettre à jour"/>
               
            </form> 
   </div>
</div>


<?php 

require'/../common/viewFooter.php'; ?>

