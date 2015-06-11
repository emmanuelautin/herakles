<?php require'/../common/viewHeader.php'; ?>


<?php
//menu administration

require '/../common/viewAdminMenuBar.php';
?>


<div class="alert">
    <?php var_dump($_GET); ?>
</div>
<div class="container">
    <div class="row">


        <h2>Gestion des clients</h2>
        <table class=" table table-striped">
            <tbody>

                <tr>
                    <th>#</th>
                    <th>Raison sociale</th>
                    <th>Adresse</th>
                    <th>Contact email</th>
                    <th>Contact Tél</th>
                    <th>Actions</th>
                    <th>
            <ul>
                <li><a class="btn btn-success" href="<?php echo MVC_PATH; ?>defaut/addCustomer">Nouveau client</a></li>
                <li><a  class="btn btn-success" href="<?php echo MVC_PATH; ?>defaut/filterCustomer">Recherche par produit commandé</a></li>
                <li><a  class="btn btn-success" href="<?php echo MVC_PATH; ?>defaut/exportCustomer">Exporter au format CSV</a></li>
            </ul>
            </th>
            </tr>

            <?php
            $customers = $data;
            if ($customers != "") {

                foreach ($customers as $order) {
                    ?> 
                    <tr>
                        <td><?= $order['id']; ?></td>
                        <td><?= $order['raison_sociale'] ?></td>
                        <td><?= $order['rue'] . " " . $order['code_postale'] . " " . $order['ville'] ?> </td>
                        <td><?= $order['contact'] ?></td>
                        <td><?= $order['contact_tel'] ?></td>
                        <td><ul><li><a href=<?= MVC_PATH; ?>defaut/getHistoryCustomer/<?= $order['id']; ?>>Voir historique</a> </li><li><a href=<?= MVC_PATH; ?>defaut/editCustomer/<?= $order['id']; ?>>Editer</a></li><li><a href=<?= MVC_PATH; ?>defaut/deleteCustomer/<?= $order['id'] ?>>Supprimer</a></li></ul>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

<?php require'/../common/viewFooter.php'; ?>

