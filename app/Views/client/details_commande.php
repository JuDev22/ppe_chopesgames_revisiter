

    
    <div class="row">
    <div class="col-md-7 col-sm-12 m-3">
    
        <div class="row align-items-center">
        <h2 class="text-white">Commande n°<?php echo $commande["NOCOMMANDE"]; ?></h2>
            <table class="table">

                <tr>
                        <th></th>
                        <th class="text-white" width="30%">Produit</th>
                        <th class="text-white" width="15%">Prix HT</th>
                        <th class="text-white" width="15%">TVA</th>
                        <th class="text-white" width="13%">Quantité</th>
                        <th class="text-white" width="25%">Total produit</th>
                </tr>
                <?php if(!empty($lignes)){foreach ($lignes as $produit):?>
        <tr>
        <td class="text-white">
                <?php if(!empty($produit["NOMIMAGE"])){ ?>
                <a class="text-white" href="<?= base_url().'index.php/Visiteur/voir_un_produit/'.$produit["NOPRODUIT"]?>"><img src="<?= base_url().'/assets/images/'.$produit["NOMIMAGE"].'.jpg'?>" width="80"/></a>
                <?php } else{?>
                    <a class="text-white" href="<?= base_url().'index.php/Visiteur/voir_un_produit/'.$produit["NOPRODUIT"]?>"><img src="<?= base_url().'/assets/images/nonimage.jpg'?>" width="80"/></a>
                <?php } ?>
            </td>
                <td class="text-white"><a  href="<?= base_url().'index.php/Visiteur/voir_un_produit/'.$produit["NOPRODUIT"]?>"><?php echo $produit["LIBELLE"]; ?></a></td>
                <td class="text-white"><?php echo $produit["PRIXHT"]; ?>€</td>
                <td class="text-white"><?php echo $produit["TAUXTVA"]; ?></td>
                <td class="text-white"><?php echo $produit["QUANTITECOMMANDEE"]; ?></td>
                <td class="text-white"><?php echo (($produit["PRIXHT"] + $produit["TAUXTVA"]) *$produit["QUANTITECOMMANDEE"]) ; ?>€</td>
                 </tr>

<?php endforeach; } ?>
<tr>
<td colspan='6' class='text-right text-white'><h4>Total: <?php echo $commande["TOTALTTC"]; ?>€</h4></td></tr>
                </table>
            </div>
            </div>
                <span style="display:inline-block; width: 40px; text-white"></span>
                <div class="col-md-3">
                    <div class="border border-secondary text-white">
                    <h3 class="text-center top text-white">Informations client</h3>
                    <table class="table">
                    <tr>
                        <th class="text-white">Nom:</th>
                        <td class="text-white"><?php echo $commande["NOM"];?></td>
                    </tr>
                    <tr>
                        <th class="text-white">Prénom:</th>
                        <td class="text-white"><?php echo $commande["PRENOM"];?></td>
                    </tr>
                    <tr>
                        <th class="text-white">Adresse:</th>
                        <td class="text-white"><?php echo $commande["ADRESSE"];?></td>
                    </tr>
                    <tr>
                        <th class="text-white">Ville:</th>
                        <td class="text-white"><?php echo $commande["VILLE"];?></td>
                    </tr>
                    <tr>
                        <th class="text-white">Code Postal:</th>
                        <td class="text-white"><?php echo $commande["CODEPOSTAL"];?></td>
                    </tr>
                    </table>
             </div>
    <div class="col-sm-1">
    </div>
           
        
        
    </div>
</div>
