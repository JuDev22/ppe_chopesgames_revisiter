<div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col">

        <div class="row align-items-center">
            <h2 class="text-white">Commande n°<?php echo $commande['NOCOMMANDE']; ?></h2>
            <table class="table">

                <tr>
                    <th></th>
                    <th width="30%" class="text-white">Produit</th>
                    <th width="15%" class="text-white">Prix HT</th>
                    <th width="15%" class="text-white">TVA</th>
                    <th width="13%" class="text-white">Quantité</th>
                    <th width="25%" class="text-white">Total produit</th>
                </tr>
                <?php if (!empty($lignes)) {
                    foreach ($lignes as $produit) : ?>
                        <tr>
                            <td>
                                <?php if (!empty($produit['NOMIMAGE'])) { ?>
                                    <a class="text-white" href="<?= base_url() . 'index.php/Visiteur/voir_un_produit/' . $produit['NOPRODUIT'] ?>"><img src="<?= base_url() . '/assets/images/' . $produit['NOMIMAGE'] . '.jpg' ?>" width="80" /></a>
                                <?php } else { ?>
                                    <a class="text-white" href="<?= base_url() . 'index.php/Visiteur/voir_un_produit/' . $produit['NOPRODUIT'] ?>"><img src="<?= base_url() . '/assets/images/nonimage.jpg' ?>" width="80" /></a>
                                <?php } ?>
                            </td>
                            <td><a class="text-white" href="<?= base_url() . 'index.php/Visiteur/voir_un_produit/' . $produit['NOPRODUIT'] ?>"><?php echo $produit['LIBELLE']; ?></a></td>
                            <td class="text-white"><?php echo $produit['PRIXHT']; ?>€</td>
                            <td class="text-white"><?php echo $produit['TAUXTVA']; ?></td>
                            <td class="text-white"><?php echo $produit['QUANTITECOMMANDEE']; ?></td>
                            <td class="text-white"><?php echo (($produit['PRIXHT'] + $produit['TAUXTVA']) * $produit['QUANTITECOMMANDEE']); ?>€</td>
                        </tr>

                <?php endforeach;
                } ?>
                <tr>
                    <td colspan='6' class='text-right'>
                        <h4 class="text-white">Total: <?php echo $commande['TOTALTTC']; ?>€</h4>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <span style="display:inline-block; width: 40px;" class="text-white"></span>






    <div class="col-md-3">
        <div class="border border-secondary">
            <h3 class="text-center top text-white">Information client</h3>
            <table class="table">
                <tr>
                    <th class="text-white">Nom:</th>
                    <td class="text-white"><?php echo $commande['NOM']; ?></td>
                </tr>
                <tr>
                    <th class="text-white">Prénom:</th>
                    <td class="text-white"><?php echo $commande['PRENOM']; ?></td>
                </tr>
                <tr>
                    <th class="text-white">Adresse:</th>
                    <td class="text-white"><?php echo $commande['ADRESSE']; ?></td>
                </tr>
                <tr>
                    <th class="text-white">Ville:</th>
                    <td class="text-white"><?php echo $commande['VILLE']; ?></td>
                </tr>
                <tr>
                    <th class="text-white">Code Postal:</th>
                    <td class="text-white"><?php echo $commande['CODEPOSTAL']; ?></td>
                </tr>
            </table>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <?php echo form_open('AdministrateurEmploye/commande_traitee/'.$commande['NOCOMMANDE']) ?>
            <input class="btn bg-success" method="post" type="submit" name="submit" value="Passer la commande à 'Traitée'">
            <?= form_close() ?>
        </div>



    </div>
</div>