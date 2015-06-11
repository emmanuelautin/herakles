<?php require'/../common/viewHeader.php'; ?>


<?php 

//menu administration
 
require '/../common/viewAdminMenuBar.php'; 

// récupération des données : 

$history = $data; 
$categorys = $more; 
?>
<div class="container">
       <h2>Editer le produit</h2>
    <div class="row">
        
            <form class="form-signin" method="POST" action="<?php echo MVC_PATH; ?>product/saveProduct">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="productName" >Nom du produit :</label>
                            <input class="form-control" type="text" name="productName" value="<?php echo $history['name_product']; ?>" placeholder="<?php echo $history['name_product']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="productDescription" >Description</label>
                            <input class="form-control" type="text" name="productDescription" value="<?php echo $history['description']; ?>" placeholder="<?php echo $history['description']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="productPrice" >Prix unitaire</label>
                            <input class="form-control" type="text" name="productPrice" value="<?php echo $history['price']; ?>" placeholder="<?php echo $history['price']; ?>" >
                        </div>  
                        <div class="form-group">
                            <label for="productStock" >Stock</label>
                            <input  class="form-control" type="text" name="productStock" value="<?php echo $history['stock'] ?>" placeholder="<?php echo $history['stock'] ?>" >
                        </div>
                        <div class="form-group">
                            
                            <label for="productCategory" >Catégorie</label>
                            
                            <select name="productCategory" class="form-control">
                            <?php foreach($categorys as $customer){ ?>
                                <option <?php if($customer['id'] === $history['id_type']){echo "selected"; } ?> value="<?= $customer['id']?>"><?=$customer['name_category'] ?></option>
                            <?php } ?>
                            </select>
                            
                    
                            <input type="hidden" value="<?php echo $history['id']; ?>" name="productId"/>
                        </div>
                    </div>
      
                 <input type="submit" data-toggle="modal" data-target="#modal" name="editProduct" class="btn btn-lg btn-success btn-block" value="Enregistrer"/>
                 <input type="submit" name="deleteProduct" class="btn btn-lg btn-danger btn-block" value="Supprimer"/>
            </form>
        
   </div>
</div>


<?php 

require'/../common/viewFooter.php'; ?>