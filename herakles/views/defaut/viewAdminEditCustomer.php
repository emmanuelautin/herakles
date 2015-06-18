<?php require'/../common/viewHeader.php'; ?>


<?php 

//menu administration
 
require '/../common/viewAdminMenuBar.php'; 

$order = $data; 
?>
<div class="container">
    <h2>Mettre à jour le client <?= $order['raison_sociale']; ?></h2>
    <div class="row">
            <form id="editCustomer" class="form-signin" method="POST" action="<?php echo MVC_PATH; ?>defaut/saveCustomer">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="contactCustomer" >Contact : </label>
                            <input class="form-control" type="text" name="customerMail" value="<?php echo $order['contact']; ?>" placeholder="<?php echo $order['raison_sociale']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="nomCustomer" >Raison sociale : </label>
                            <input class="form-control" type="text" name="customerName" value="<?php echo $order['raison_sociale']; ?>" placeholder="<?php echo $order['raison_sociale']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="customerTel" >Contact Téléphonique : </label>
                            <input class="form-control" type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="customerTel" value="<?= $order['contact_tel'] ?>" placeholder="<?= $order['contact_tel'] ?>" >
                        </div>
                        <div class="form-group">
                            <label for="nomRue" >rue : </label>
                            <input class="form-control" type="text" name="streetName" value="<?php echo $order['rue']; ?>" placeholder="<?php echo $order['rue']; ?>" >
                        </div>  
                        <div class="form-group">
                            <label for="nomCodePostale" >Code postale: </label>
                            <input  class="form-control" type="text" name="zipNumber" value="<?php echo $order['code_postale'] ?>" placeholder="<?php echo $order['code_postale'] ?>" >
                        </div>
                        <div class="form-group">
                            <label for="nomVille" >Ville: </label>
                            <input  class="form-control" type="text" name="cityName" value="<?php echo $order['ville'] ?>" placeholder="<?php echo $order['ville'] ?>" >
                            <input type="hidden" value="<?php echo $data['id']; ?>" name="customerId"/>
                        </div>
                    </div>
      
                 <input type="submit" data-toggle="modal" data-target="#modal" name="editCustomer" class="btn btn-lg btn-success btn-block" value="Enregistrer"/>
                
            </form>
        
        
   </div>
</div>


<?php 

require'/../common/viewFooter.php'; ?>

<script>
   jQuery(document).ready(function(){
      jQuery("#editCustomer").validate({
          
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