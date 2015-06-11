<?php require'/../common/viewHeader.php'; ?>


<?php 

//menu administration
 
require '/../common/viewAdminMenuBar.php'; 

$orderInfo = $data; 
$Orderproducts = $more;
$historys = $must; 



?>

<div class="container">
    
    <div class="row">
        <h3>Récapitulatif commande n°<?= $orderInfo['id_commande']; ?> :</h3>
            <table class=" table table-striped">
    <thead>
        <tr>
            <th># Numéro de commande</th>
            <th>Client</th>
            <th>Date Création</th>
            <th>Date dernière Edition</th>
            <th>Status</th>
            <th>Actions</th>
            <th><a href="<?php echo MVC_PATH;?>order/addOrder">Nouvelle commande</a></th>
        </tr>
        
         <?php if($orderInfo != ""){ ?>
        
                <tr>  
                    <td><?= $orderInfo['id_commande']; ?></td>
                    <td><?= $orderInfo['customer_name']; ?></td>
               
                    <td><?= $orderInfo['date_add']; ?></td>
                    <td><?= $orderInfo['date_edit']; ?></td>
                     <td><?= $orderInfo['statut']; ?></td>
                          <td><ul><li><a href=<?= MVC_PATH; ?>order/viewOrder/<?= $orderInfo['id_commande'];?>>Détail</a></li><li><a href=<?= MVC_PATH; ?>order/editOrder/<?= $orderInfo['id_commande'];?>>Editer commande</a></li><li><a href=<?= MVC_PATH; ?>order/deleteOrder/<?= $orderInfo['id_commande']?>>Supprimer commande</a></li></ul></td>
                    <td></td>
                </tr>
         <?php }  ?>
      
    </thead>
</table>
        </div>
    
    <div class="row">
        
  
        <h3>Détail commande n°<?= $orderInfo['id_commande']; ?> :</h3>
              <table class=" table table-striped">
                  <tbody>
        <tr>
            <th>#</th>
            <th>Nom du produit</th>
            <th>Quantité</th>
            <th>Prix unitaire HT</th>
            <th>Prix unitaire TTC</th>
            <th>TOTAL</th>
        </tr>
        
         <?php if($Orderproducts != ""){ ?>
        
                <?php foreach($Orderproducts as $history) {?>
                <tr>  
                    <td><?= $history['id_product']; ?></td>
                    <td><?= $history['name_product']; ?></td>
                    <td><?= $history['quantity']; ?></td>
                    <td><?= $history['price'];?> €</td>
                    <td><?= $history['price_TTC'];?> €</td>
                    <td><?= $history['price_total'];?> €</td>
                </tr>
               
         <?php } // endfor?>
                 <tr><td><b>TOTAL TTC : <?= $history[0] ?> €</b></td></tr>
               <?php } //endif ?>
               
                  </tbody>
</table>
          </div>
    <div class="row">
        <h3>Historique des modifications commande n°<?= $orderInfo['id_commande']; ?> :</h3>   
                   <table class=" table table-striped">
                       <tbody>
        <tr>
            <th>Version commande N°</th>
            <th>Client</th>
            <th>Date et heure de l'action</th>
            <th>Statut de la commande</th>
            <th>Type d'action</th>
         
 
        </tr>
        
         <?php if($historys != ""){ ?>
        
       
             <?php foreach($historys as $history) {?>
                <tr>  
                    <td><?= $history['version']; ?></td>
                    <td><?= $history['raison_sociale']; ?></td>
                    <td><?= $history['date_action'];?> </td>
                    <td><?= $history['name'];?> </td>
                    <td><?php if($history['action'] == "update"){echo "Mise à jour";}?> </td>
                   
                </tr>
               
         <?php } }else{// endfor?>
                 
    <td>Cette commande n'a jamais été modifiée.</td>
         <?php } ?>
                   </tbody>
</table>
        
</div>
    
    <div class="row">
        <a class="btn btn-success" href="<?= MVC_PATH; ?>order/getdevisOrder/<?= $orderInfo['id_commande'];?>">Générer un devis</a>
        <a  class="btn btn-success" href="<?= MVC_PATH; ?>order/getfactureOrder/<?= $orderInfo['id_commande'];?>">Générer une facture</a>
    </div>
</div>

<?php require'/../common/viewFooter.php'; ?>
