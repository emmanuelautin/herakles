<ul class="nav nav-pills">
    <li id="menuCustomer" role="presentation"><a href="<?= MVC_PATH; ?>defaut/">Clients</a></li>
    <li id="menuOrder" role="presentation"><a href="<?= MVC_PATH; ?>order/">Commandes</a></li>
    <li id="menuProduct" role="presentation"><a href="<?= MVC_PATH; ?>product/"">Produits</a></li>
    <?php if(isset($_SESSION) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
    <li id="menuUser" role="presentation"><a href="<?= MVC_PATH; ?>user/"">Utilisateurs</a></li>
    <?php } ?>
</ul>  

