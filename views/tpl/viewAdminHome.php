<?php require'viewHeader.php'; ?>


<?php 

//menu administration
 
require 'viewAdminMenuBar.php'; 

?>


<div class="alert">
    <?php var_dump($_GET); ?>
</div>
<table class=" table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Raison sociale</th>
            <th>Adresse</th>
            <th>Contact</th>
            <th>Actions</th>
            <th><a href="index.php?action=addClient">Nouveau</a></th>
        </tr>
        
         <?php foreach($customers as $order){ ?>
                <tr>
                    <?php 
                    echo '<td>'.$order['id'].'</td>'; 
                    echo '<td>'.$order['raison_sociale'].'</td>';
                    echo '<td>'.$order['rue']." ".$order['code_postale']." ".$order['ville'].'</td>';
                    echo '<td>'.$order['contact'].'</td>';
                    echo '<td><a href="defaut/editCustomer/'.$order['id'].'">Editer</a> <a href="defaut/deleteCustomer/'.$order['id'].'">Supprimer</a></td>';
                    ?>
                </tr>
         <?php } ?>
    </thead>
</table>


<?php require'viewFooter.php'; ?>

