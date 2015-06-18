<?php
require'viewHeader.php';
?>


<div class="container">

    <div class="row">

        <div class="col-md-12">

            <form class="form-signin" role="form" method="POST">
                <h2 class="form-signin-heading">Connexion utilisateur :</h2>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">Adresse email</label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email_adm" required autofocus>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="mdp_adm" required>
                </div>
                <button class="btn btn-lg btn-success btn-block" type="submit">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php
require'viewFooter.php';

