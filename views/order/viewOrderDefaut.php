<?php require'/../common/viewHeader.php'; ?>


<?php 

//menu administration
 
require '/../common/viewAdminMenuBar.php'; 

?>

<div class="alert">
    <?php var_dump($_GET); ?>
</div>
<h2>Gestion des commandes</h2>
<div class="row">
    <div class="col-md-2">
        <a class="btn btn-success" href="<?php echo MVC_PATH;?>order/addOrder">Créer Nouvelle commande</a>
    </div>
</div>

<table class=" table table-striped">
    <tbody>
        <tr>
            <th># Numéro de commande</th>
            <th>Client</th>
            <th>Date Création</th>
            <th>Date dernière Edition</th>
            <th>Status</th>
            <th>Actions</th>
            <th><a href="<?php echo MVC_PATH;?>order/addOrder">Nouvelle commande</a></th>
        </tr>
        
         <?php
         $orders = $data;
         
         
        
         
         if($orders != ""){ 
          
         foreach($orders as $order){ ?>  
                <tr>  
                    <td><?= $order['id_commande']; ?></td>
                    <td><?= $order['customer_name']; ?></td>
                  
                    <td><?= $order['date_add']; ?></td>
                    <td><?= $order['date_edit']; ?></td>
                     <td><?= $order['statut']; ?></td>
                       <td><ul><li><a href=<?= MVC_PATH; ?>order/viewOrder/<?= $order['id_commande'];?>>Détail</a></li><li><a href=<?= MVC_PATH; ?>order/editOrder/<?= $order['id_commande'];?>>Editer commande</a></li><li><a href=<?= MVC_PATH; ?>order/deleteOrder/<?= $order['id_commande']?>>Supprimer commande</a></li></ul></td>
                    <td></td>
                </tr>
         <?php } 
         }?>
    </tbody>
</table>


<?php require'/../common/viewFooter.php'; ?>
