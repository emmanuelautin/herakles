<?php
require'/../common/viewHeader.php';
require '/../common/viewAdminMenuBar.php';

$products = $data;
?>


<h2>Recherche de client par produit commandé</h2>


<div class="form-group">
    <form class="form-signin" method="POST" action="<?= MVC_PATH; ?>defaut/filterCustomerByProduct">
        <select name="filteredByProducts" class="form-control">
            <?php foreach ($products as $product) { ?>
                <option value="<?= $product['id'] ?>"><?= $product['name_product'] ?></option>
            <?php } ?>
        </select>

        <input class="btn btn-lg btn-success btn-block" type="submit" value="Rechercher"/>
</div>
</form>








<?php require'/../common/viewFooter.php'; ?>