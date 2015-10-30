<?php require('/../common/viewHeader.php'); ?>

<div class="container">
    <div class="row">
       
        <form action="<?= MVC_PATH ?>login/logUser" id="loginUser" class="form-signin" method="POST">
            <div class="col-md-4">
            </div>
            
            <div class="col-md-4">
                 <h2>Se connecter : </h2>
            <div class="form-group">
                <input id="nameUser" class="form-control" type="text" name="nameUser" placeholder="Identifiant" >
            </div>
            <div class="form-group">
                <input id="pwdUser" class="form-control" type="password" name="pwdUser" value="" placeholder="Mot de passe" >
            </div>
                <input type="submit"  name="loginUser" class="btn btn-lg btn-success btn-block" value="Connexion"/>
            </div>
            <div class="col-md-4">
            </div>
        </form>
    </div>
    <div class="row">
         <div class="col-md-4">
            </div>
         <div class="col-md-4">
             <?php if(isset($data)){
                 
                 $errorMessage = $data; 
             
             ?>
                <p class="bg-danger"><?= $errorMessage; ?></p>
             <?php } ?>
            </div>
         <div class="col-md-4">
            </div>
    </div>
</div>

<?php
require('/../common/viewFooter.php');