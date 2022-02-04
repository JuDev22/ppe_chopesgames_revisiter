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
                foreach ($clients as $client) {
                    $id = $client['NOCLIENT']; ?>
                    <?php foreach ($commandes as $commande) { 
                        //dd($commande);
                        //$noCommande = $commande['NOCOMMANDE']; ?>
                        <tr onclick="window.location.href = '<?php echo site_url('AdministrateurEmploye/details_commande_non_traitee/' .$commande['NOCOMMANDE']); ?>'" class="hover">
                        <?php } ?>
                        <td>
                            <?php foreach ($commandes as $commande) {
                                $id_clientCommande = $commande['NOCLIENT'];
                                if ($id == $id_clientCommande) {
                                    echo $commande['DATECOMMANDE'];
                                }
                            } ?> </td>
                        <td> <?php echo $client['NOM'];
                                echo ' ' . $client['PRENOM']; ?> </td>
                        <td><?php foreach ($commandes as $commande) {
                                $id_clientCommande = $commande['NOCLIENT'];
                                if ($id == $id_clientCommande) {
                                    echo $commande['TOTALTTC'] . "€";
                                }
                            } ?></td>
                        </tr>
                    <?php } ?>
            </table>
        </div>
    </div>
</div>