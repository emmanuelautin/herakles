<?php require'/../common/viewHeader.php'; 
 
require '/../common/viewAdminMenuBar.php'; 

?>

<div class="alert">
    <?php var_dump($_GET); ?>
</div>

<h2>Gestion des Produits</h2>

<div class="row">
    <div class="col-md-2">
        <a class="btn btn-success" href="<?php echo MVC_PATH;?>product/addProduct">Nouveau Produit</a>
    </div>
    <div class="col-md-2">
        <a class="btn btn-success" href="<?php echo MVC_PATH;?>product/addCategory">Nouvelle Catégorie</a>
    </div>
</div>
<table class=" table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Désignation</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Catégorie</th>
             <th>Actions</th>
            <th><a href="<?php echo MVC_PATH;?>product/addProduct">Nouveau Produit</a></th>
            <th><a href="<?php echo MVC_PATH;?>product/addCategory">Nouvelle Catégorie</a></th>
        </tr>
        
         <?php
         $Orderproducts = $data; 
         
     
         
         foreach($Orderproducts as $history){ ?> 
                <tr>
                    <td><?= $history['id']; ?></td>
                    <td><?= $history['name_product'] ?></td>
                    <td><?= $history['description']?></td>
                    <td><?= $history['price']?></td>
                    <td><?= $history['stock']?></td>
                    <td><?= $history['name_category']?></td>
                    <td><a href=<?= MVC_PATH; ?>product/editProduct/<?= $history['id'];?>>Editer</a> <a href=<?= MVC_PATH; ?>product/deleteProduct/<?= $history['id']?>>Supprimer</a></td>
                </tr>
         <?php } ?>
    </thead>
</table>

<?php require'/../common/viewFooter.php'; ?>