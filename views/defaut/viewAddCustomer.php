<?php require'/../common/viewHeader.php'; ?>


<?php 

//menu administration
 
require '/../common/viewAdminMenuBar.php'; ?>

<div class="container">
       
    <div class="row">
        <h1>Ajouter un nouveau client</h1>
            <form  id="addCustomer" class="form-signin" method="POST" action="<?= MVC_PATH ?>defaut/addCustomer">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="contactCustomer" >Contact : </label>
                            <input id="customerEmail" class="form-control" type="email" name="customerMail" placeholder="Email" >
                        </div>
                        <div class="form-group">
                            <label for="nomCustomer" >Raison sociale : </label>
                            <input id="customerName" class="form-control" type="text" name="customerName" value="" placeholder="Nom" >
                        </div>
                        <div class="form-group">
                            <label for="customerTel" >Contact Téléphonique : </label>
                            <input id="customerTel" class="form-control" type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="customerTel" value="" placeholder="Numéro de téléphone" >
                        </div>
                        <div class="form-group">
                            <label for="nomRue" >rue : </label>
                            <input id="customerStreet" class="form-control" type="text" name="streetName" value="" placeholder="Rue" >
                        </div>  
                        <div class="form-group">
                            <label for="nomCodePostale" >Code postale: </label>
                            <input id="customerZip" class="form-control" type="text" name="zipNumber" value="" placeholder="Code postale" >
                        </div>
                        <div class="form-group">
                            <label for="nomVille" >Ville: </label>
                            <input id="customerCity" class="form-control" type="text" name="cityName" value="" placeholder="Ville" >
                        </div>
                    </div>
      
                 <input type="submit" data-toggle="modal" data-target="#modal" name="addCustomer" class="btn btn-lg btn-success btn-block" value="Ajouter"/>
               
            </form>
        
   </div>
</div>
<?php 

require'/../common/viewFooter.php'; ?>

<script>
   jQuery(document).ready(function(){
      jQuery("#addCustomer").validate({
          
          rules:{
              
              "customerMail" :{
                  "email": true,
                  "maxlength": 255,
                  "required": true
              },
              
              "customerName" :{
                  "maxlength": 255,
                  "required": true
                  
              },
              
              "customerTel" : {
                  "required": true,
                  "phonetel": true
              },
              
              "streetName" : {
                  "maxlength": 255,
                  "required": true
              },
              
              "zipNumber" : {
                  
                  "required": true,
                  //"regex": /^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/
                  "zipcode": true
              },
              
              "cityName" : {
                  "maxlength": 255,
                  "required": true
                  
              }
          }
       
      });
    });
</script>