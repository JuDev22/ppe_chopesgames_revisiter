<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="container col-md-5 m-5">
            <h5 class="text-white">Pour connaître le détail d'un commande, cliquer sur la ligne (date, client, total).</h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="33%" class="text-white">Date de commande</th>
                        <th width="33%" class="text-white">Client</th>
                        <th width="33%" class="text-white">Total</th>

                    </tr>
                </thead>
                <?php
                foreach ($commandesNonTraitees as $CommandeNonTraitee) { ?>
                    <tr onclick="window.location.href = '<?php echo site_url('AdministrateurEmploye/details_commande_non_traitee/' .$CommandeNonTraitee['NOCOMMANDE']); ?>'" class="hover">
                        <td class="text-white"> 
                            <?= $CommandeNonTraitee['DATECOMMANDE'] ?>
                        </td>
                        <td class="text-white"> 
                            <?= $CommandeNonTraitee['NOM'] . ' ' . $CommandeNonTraitee['PRENOM'] ?> 
                        </td>
                        <td class="text-white">
                            <?= $CommandeNonTraitee['TOTALTTC'] . "€"; ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>