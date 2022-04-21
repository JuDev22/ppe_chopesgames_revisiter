<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="container col-md-5">
            <h5>Pour connaître le détail d'un commande, cliquer sur la ligne (date, client, total).</h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="33%">Date de commande</th>
                        <th width="33%">Client</th>
                        <th width="33%">Total</th>

                    </tr>
                </thead>
                <?php
                foreach ($commandesNonTraitees as $CommandeNonTraitee) { ?>
                    <tr onclick="window.location.href = '<?php echo site_url('AdministrateurEmploye/details_commande_non_traitee/' .$CommandeNonTraitee['NOCOMMANDE']); ?>'" class="hover">
                        <td> 
                            <?= $CommandeNonTraitee['DATECOMMANDE'] ?>
                        </td>
                        <td> 
                            <?= $CommandeNonTraitee['NOM'] . ' ' . $CommandeNonTraitee['PRENOM'] ?> 
                        </td>
                        <td>
                            <?= $CommandeNonTraitee['TOTALTTC'] . "€"; ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>