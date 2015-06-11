<?php require'/../common/viewHeader.php'; ?>


<?php 

//menu administration
 
require '/../common/viewAdminMenuBar.php'; ?>

<div class="container">
       
    <div class="row">
        <h1>Ajouter un nouveau client</h1>
            <form class="form-signin" method="POST" action="<?= MVC_PATH ?>defaut/addCustomer">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="contactCustomer" >Contact : </label>
                            <input class="form-control" type="text" name="customerMail" value="" placeholder="Email" >
                        </div>
                        <div class="form-group">
                            <label for="nomCustomer" >Raison sociale : </label>
                            <input class="form-control" type="text" name="customerName" value="" placeholder="Nom" >
                        </div>
                        <div class="form-group">
                            <label for="customerTel" >Contact Téléphonique : </label>
                            <input class="form-control" type="text" name="customerTel" value="" placeholder="Numéro de téléphone" >
                        </div>
                        <div class="form-group">
                            <label for="nomRue" >rue : </label>
                            <input class="form-control" type="text" name="streetName" value="" placeholder="Rue" >
                        </div>  
                        <div class="form-group">
                            <label for="nomCodePostale" >Code postale: </label>
                            <input  class="form-control" type="text" name="zipNumber" value="" placeholder="Code postale" >
                        </div>
                        <div class="form-group">
                            <label for="nomVille" >Ville: </label>
                            <input  class="form-control" type="text" name="cityName" value="" placeholder="Ville" >
                        </div>
                    </div>
      
                 <input type="submit" data-toggle="modal" data-target="#modal" name="addCustomer" class="btn btn-lg btn-success btn-block" value="Ajouter"/>
               
            </form>
        
   </div>
</div>


<?php 

require'/../common/viewFooter.php'; ?>
