<?php require '/../common/viewHeader.php'; ?>


<?php 

//menu administration
 
require '/../common/viewAdminMenuBar.php'; 

$categorys = $more; 

?>
<div class="container">
    <h1>Ajouter un nouveau produit</h1>
    <div class="row">
            <form class="form-signin" method="POST" action="<?php echo MVC_PATH; ?>product/addProduct">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="productName" >Nom du produit :</label>
                            <input class="form-control" type="text" name="productName" value="" placeholder="Nom" >
                        </div>
                        <div class="form-group">
                            <label for="productDescription" >Description</label>
                            <input class="form-control" type="text" name="productDescription" value="" placeholder="Description" >
                        </div>
                        <div class="form-group">
                            <label for="productPrice" >Prix unitaire</label>
                            <input class="form-control" type="number" step="0.01" min="0" name="productPrice" value="" placeholder="Prix" >
                        </div>  
                        <div class="form-group">
                            <label for="productStock" >Stock</label>
                            <input  class="form-control" type="number" min="0" name="productStock" value="" placeholder="Stock" >
                        </div>
                        <div class="form-group">
                            <label for="productCategory" >Catégorie</label>
                                <select name="productCategory" class="form-control">
                            <?php foreach($categorys as $customer){ ?>
                                <option value="<?= $customer['id']?>"><?=$customer['name_category'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                 <input type="submit" data-toggle="modal" data-target="#modal" name="addProduct" class="btn btn-lg btn-success btn-block" value="Ajouter produit"/>
            </form>
        
   </div>
</div>


<?php 

require'/../common/viewFooter.php'; ?>