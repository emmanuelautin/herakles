<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Intranet Herakles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/mvc/front/css/style.css" type="text/css"  />
</head>

    <body>
        <header>
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="index.php" class="logo">Herakles</a>
                            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'true') { ?>
                                <div class="btn-group" role="group">

                                    <form action="index.php" method="POST">
                                        <input type="hidden" value="deconnexion" name="deconnexion">
                                        <input type="submit" class="btn btn-default" value="deconnexion">
                                    </form>
                                </div>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
            </div>
        </header>   
        <div class="container top">



