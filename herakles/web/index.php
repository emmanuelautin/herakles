<?php

//on definit le chemin absolu du site
define('ROOT', str_replace('web/index.php','',$_SERVER['SCRIPT_FILENAME']));
define('TPL_PATH',str_replace('web/index.php','',$_SERVER['SCRIPT_FILENAME'].'/views/tpl/'));
define('MVC_PATH', str_replace('web/index.php','',$_SERVER['SCRIPT_NAME']));

// on appelle init.php pour charger core/controller.php et core/App.php
require_once ROOT.'init.php';

//on demarre un objet App
$app = new App();

/*echo '<pre>';
print_r($app);
echo '</pre>';*/

?>
