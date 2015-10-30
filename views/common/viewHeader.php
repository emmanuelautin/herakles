<?php 



 ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Intranet Herakles</title>
    <link rel="stylesheet" href="/herakles/front/css/style.css" type="text/css"  />
    <link rel="stylesheet" href="/herakles/front/css/bootstrap.css" type="text/css" />
</head>
    <body>
        <header>
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>" class="logo">Herakles</a>
                            <?php if (isset($_SESSION) && isset($_SESSION['role'])) { ?>
                            <a class="logout" href="<?= MVC_PATH;?>login/logout">Déconnexion</a>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
            </div>
        </header>   
        <div class="container top">



