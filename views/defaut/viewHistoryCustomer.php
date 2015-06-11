
<?php 
require'/../common/viewHeader.php'; 
require '/../common/viewAdminMenuBar.php'; 


$customerHistory = $data;


?>

<div class="container">
    
    
    
 <div class="row">
     <h2>Historique client</h2>
     <table class=" table table-striped">
                       <tbody>
        <?php if(!empty($customerHistory)){ ?>
     
        <h3>Historique du client <?= $customerHistory[0]['raison_sociale']; ?> :</h3>   
                   
        <tr>
            <th>Version commande N°</th>
            <th>Client</th>
            <th>Date et heure de l'action</th>
            <th>Statut de la commande</th>
            <th>Type d'action</th>
         
 
        </tr>
        
      
        
       
             <?php foreach($customerHistory as $history) {?>
                <tr>  
                    <td><?= $history['version']; ?></td>
                    <td><?= $history['raison_sociale']; ?></td>
                    <td><?= $history['date_action'];?> </td>
                    <td><?= $history['name'];?> </td>
                    <td><?php if($history['action'] == "update"){echo "Mise à jour";}?> </td>
                   
                </tr>
               
         <?php } }else{// endfor?>   
                <tr><td>Ce client n'a pas d'historique</td></tr>
         <?php } ?>
                   </tbody>
</table>
        
</div>

</div>


<?php 

require'/../common/viewFooter.php'; ?>
