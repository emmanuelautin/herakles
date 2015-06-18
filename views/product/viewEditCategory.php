<?php require'/../common/viewHeader.php'; ?>


<?php 

//menu administration
 
require '/../common/viewAdminMenuBar.php'; ?>

<?php 
 $customer = $data ;
 
?>
<div class="container">
       
    <div class="row">
        <h1>Editer la catégorie de produit</h1>
            <form class="form-signin" method="POST" action="<?= MVC_PATH ?>product/editCategory">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="categoryName" >Nom de la catégorie</label>
                            <?php foreach($customer as $cat){ ?>
                            
                                <input class="form-control" type="text" name="categoryName"  value="<?= $cat['name_category']; ?>" >
                                <input type="hidden" name="categoryId" value="<?= $cat['id']; ?>">
                            <?php } ?>
                            
                          
                        </div>
                    </div>
      
                 <input type="submit" data-toggle="modal" data-target="#modal" name="editCategory" class="btn btn-lg btn-success btn-block" value="Mettre à jour"/>
                
            </form>
        
   </div>
    
    </div>

<?php require '/../common/viewFooter.php'; ?>