<?php require'/../common/viewHeader.php'; ?>


<?php 

//menu administration
 
require '/../common/viewAdminMenuBar.php'; ?>

<div class="container">
       
    <div class="row">
        <h1>Ajouter une nouvelle catégorie de produit</h1>
            <form class="form-signin" method="POST" action="<?= MVC_PATH ?>product/addCategory">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="categoryName" >Nom de la catégorie</label>
                            <input class="form-control" type="text" name="categoryName" value="" placeholder="Nom de la Catégorie" >
                        </div>
                    </div>
      
                 <input type="submit" data-toggle="modal" data-target="#modal" name="addCategory" class="btn btn-lg btn-success btn-block" value="Ajouter"/>
                
            </form>
        
   </div>
    <div class="row">
        
    
                <table class=" table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom de la catégorie</th>
                        <th>Actions</th>
                    </tr>

                     <?php
                     $categorys = $data; 
                     if($categorys != ""){ 

                     foreach($categorys as $customer){ ?> 
                            <tr>
                                <td><?= $customer['id']; ?></td>
                                <td><?= $customer['name_category']; ?></td>
                                <td><a class="edit" href="<?php echo MVC_PATH; ?>product/editCategory/<?= $customer['id']; ?>">Editer</a> <a class="delete" href="<?php echo MVC_PATH; ?>product/deleteCategory/<?= $customer['id']; ?>">Supprimer</a></td>
                            </tr>
                     <?php } 
                     }?>
                </thead>
            </table>
        </div>
   
</div>

<?php require '/../common/viewFooter.php'; ?>