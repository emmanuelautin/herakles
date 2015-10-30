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
        <ul class="action-panel">
            <li><a  class="btn btn-success add" href="<?php echo MVC_PATH;?>order/addOrder">Créer Nouvelle commande</a></li>
        </ul>   
    </div>
</div>

<table class=" table table-striped">
    <tbody>
        <tr>
            <th># Numéro de commande</th>
            <th>Client</th>
            <th>Date Création</th>
            <th>Status</th>
            <th>Dernière modification</th>
            <th>Actions</th>
           
        </tr>
        
         <?php
         $orders = $data; 
         if($orders != ""){ 
          
         foreach($orders as $order){ ?>  
                <tr>  
                    <td><?= $order['id_commande']; ?></td>
                    <td><?= $order['customer_name']; ?></td>
                  
                    <td><?= $order['date_add']; ?></td>
                     <td><?= $order['statut']; ?></td>
                     <td>Il y a <?= $order['date_diff']; ?> jours <br/>  (<?= $order['date_edit']; ?>)</td>
                       <td><ul><li><a class="view" href=<?= MVC_PATH; ?>order/viewOrder/<?= $order['id_commande'];?>>Détails</a></li><li><a class="edit" href=<?= MVC_PATH; ?>order/editOrder/<?= $order['id_commande'];?>>Editer</a></li><li><a class="delete" href=<?= MVC_PATH; ?>order/deleteOrder/<?= $order['id_commande']?>>Supprimer</a></li></ul></td>
                    <td></td>
                </tr>
         <?php } 
         }?>
    </tbody>
</table>


<?php require'/../common/viewFooter.php'; ?>
