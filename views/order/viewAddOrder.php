<?php require'/../common/viewHeader.php'; ?>


<?php 
$Orderproducts = $data;
$customers = $more; 




//menu administration
 
require '/../common/viewAdminMenuBar.php'; ?>

<div class="container">
       
    <div class="row">
        <h1>Créer une nouvelle commande</h1>
            <form class="form-signin" method="POST" action="<?= MVC_PATH ?>order/saveOrder">
                    <div class="col-md-12">
                      <div class="form-group">
                            
                            <label for="orderCustomer" >Client</label>
                            
                            <select name="orderCustomer" class="form-control">
                            <?php foreach($customers as $customer){ ?>
                                <option value="<?= $customer['id']?>"><?=$customer['raison_sociale'] ?></option>
                            <?php } ?>
                            </select>
                      </div>
                        
                        <div class="form-group">
                            <table class=" table table-striped">
                                <tr>
                                <th>Nom du produit</th>
                                <th>Prix</th>
                                <th>Nombre en stock</th>
                                <th>Catégorie</th>
                                <th>Quantité</th>
                                </tr>
                         <?php foreach($Orderproducts as $history){ ?>
                            
                                <tr>
                                <td><?= $history['name_product']; ?></td>
                                <td><?= $history['price']; ?> € HT</td>
                                <td><?= $history['stock']; ?> </td>
                                <td><?= $history['name_category']; ?></td>
                                <td><input class="form-control"  type="text" name="<?= 'productId-'.$history['id'];?>" value="" /></td>
                                </tr>
                         <?php } ?>
                           
                           </table>
                        </div>

                    </div>
      
                 <input type="submit" data-toggle="modal" data-target="#modal" name="saveOrder" class="btn btn-lg btn-success btn-block" value="Créer la commande"/>
               
            </form> 
   </div>
</div>


<?php 

require'/../common/viewFooter.php'; ?>
